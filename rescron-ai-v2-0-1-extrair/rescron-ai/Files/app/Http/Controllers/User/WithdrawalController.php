<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Jobs\ProcessAutoWithdrawJob;
use App\Models\AutoWallet;
use App\Models\DepositCoin;
use App\Models\User;
use App\Models\Withdrawal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use OTPHP\TOTP;

class WithdrawalController extends Controller
{
    //index of all withdrawals
    public function index(Request $request)
    {
        $page_title = 'My Withdrawals';

        if ($request->s) {
            $withdrawals = user()
                ->withdrawals()
                ->with('depositCoin')
                ->where('ref', 'LIKE', '%' . $request->s . '%')
                ->orderBy('id', 'DESC')
                ->paginate(site('pagination'));
        } else {
            $withdrawals = user()
                ->withdrawals()
                ->with('depositCoin')
                ->orderBy('id', 'DESC')
                ->paginate(site('pagination'));
        }



        $coins = DepositCoin::where('can_withdraw', '1')->get();
        $auto_wallets = user()->autoWallets()->get();

        $auto_wallets_array  = [];
        foreach ($auto_wallets as $wallet) {
            $auto_wallets_array[$wallet->depositCoin->code] = $wallet->wallet_address;
            // array_push($auto_wallets_array, $wallet->depositCoin->code);
            // whitelist wallet
            if ($wallet->whitelisted == 0) {
                $created_date = strtotime($wallet->created_at);
                $to_be_whitelisted = (site('wallet_lock_duration') * 86400) + $created_date;
                if ($to_be_whitelisted < time()) {
                    $whitelist = AutoWallet::find($wallet->id);
                    $whitelist->whitelisted = 1;
                    $whitelist->save();
                }
            }
        }

        // dd($auto_wallets_array);
        return view('user.withdrawals.index', compact(
            'page_title',
            'withdrawals',
            'coins',
            'auto_wallets',
            'auto_wallets_array'
        ));
    }



    //new deposit 
    public function newWithdrawal(Request $request)
    {

        $request->validate([
            'amount' => 'required|numeric',
            'currency_code' => 'required',
            'wallet_address' => 'required'
        ]);

        //check min and max
        $amount_before_fee = $request->amount;
        $currency = $request->currency_code;
        $fee = site('withdrawal_fee') / 100 * $amount_before_fee;
        $amount =  $amount_before_fee - $fee;
        if ($amount_before_fee < site('min_withdrawal') || $amount_before_fee > site('max_withdrawal')) {
            return response()->json(validationError('Min or max withdrawal amount not met'), 422);
        }

        //check for available balance
        if (user()->balance < $amount_before_fee) {
            return response()->json(validationError('Insufficient balance'), 422);
        }


        $coin = DepositCoin::where('code', $currency)->where('can_withdraw', 1)->first();
        if (!$coin) {
            return response()->json(validationError('The Payment method you have selected is not allowed'), 422);
        }

        // restrict withdrawal to coin that has been deposited by user to prevent balance error
        $has_deposited_via_coin = user()->deposits()->where('deposit_coin_id', $coin->id)->first();
        if (!$has_deposited_via_coin) {
            return response()->json(validationError('You have not made deposit via ' . $coin->code . ' before'), 422);
        }


        // check for regex
        $wallet_regex = $coin->wallet_regex; //^(0x)[0-9A-Fa-f]{40}$
        if (!preg_match('/' . $wallet_regex . '/', $request->wallet_address)) {
            return response()->json(validationError('The wallet you submitted is not valid for your selected coin'), 422);
        }

        $converted_amount = convertFiatToCrypto(site('currency'), $currency,  $amount);
        $ref = uniqid('trx-');
        // for auto withdrawal
        if (site('auto_withdraw') == 1) {
            // check that the address and code matches stored
            $auto_wallet = user()->autoWallets()->where('wallet_address', $request->wallet_address)->first();
            if (!$auto_wallet) {
                return response()->json(validationError('We could not verify the wallet address submitted'), 422);
            }

            if ($auto_wallet->depositCoin->code !== $currency) {
                return response()->json(validationError('We could not verify the wallet address submitted'), 422);
            }

            // allow withdrawal only if the address is whitelisted
            if ($auto_wallet->whitelisted == 0) {
                return response()->json(validationError('The wallet you submitted is not whitelisted yet'), 422);
            }

            $api_key = env('NP_API_KEY');
            // Verify that there is sufficient balance to cover the withdrawal
            $response = Http::withHeaders([
                'x-api-key' => $api_key,
            ])->get('https://api.nowpayments.io/v1/balance');

            // Check if the request was successful
            if (!$response->successful()) {
                return response()->json(validationError($response->status() . ' Error ocurred'), 422);
            }

            $balances = $response->json();
            $currency_lower = strtolower($currency);
            if (!array_key_exists($currency_lower, $balances)) {
                return response()->json(validationError('Error! Insufficient funds to cover withdrawal'), 422);
            }

            $balance = $balances[$currency_lower]['amount'];
            if ($converted_amount > $balance) {
                return response()->json(validationError('Error! Insufficient funds to cover withdrawal'), 422);
            }

            $response = Http::withHeaders([
                'x-api-key' => $api_key,
                'Content-Type' => 'application/json',
            ])->post('https://api.nowpayments.io/v1/payout/validate-address', [
                'address' => $request->wallet_address,
                'currency' => $currency_lower,
                'extra_id' => null,
            ]);

            // Check if the request was successful
            if (!$response->successful()) {
                return response()->json(validationError('Error! Wallet Address not whitelisted'), 422);
            }


            // dispatch job
            ProcessAutoWithdrawJob::dispatch($request->wallet_address, $currency_lower, $converted_amount, $ref)->delay(now()->addMinutes(1));

            $type = 'auto';
        } else {
            $type = 'manual';
            
        }


        $coin_id = $coin->id;
        //debit the user
        $debit = User::find(user()->id);
        $debit->balance = user()->balance - $amount_before_fee;
        $debit->save();


        //log transaction
        recordNewTransaction($amount_before_fee, user()->id, 'debit', 'New Withdrawal Request');

        //store the withdrawal
        $withdrawal = new Withdrawal();
        $withdrawal->user_id = user()->id;
        $withdrawal->deposit_coin_id = $coin->id;
        $withdrawal->wallet_address = $request->wallet_address;
        $withdrawal->amount = $amount_before_fee;
        $withdrawal->converted_amount = $converted_amount;
        $withdrawal->fee = $fee;
        $withdrawal->status = 'pending';
        $withdrawal->type = $type;
        $withdrawal->ref = $ref;
        $withdrawal->save();

        // Notify new withdrawal
        sendWithdrawalEmail($withdrawal);

        $withdrawalData = [
            'amount' => $amount_before_fee,
            'fee' => $fee,
            'currency' => $currency,
            'converted_amount' => $converted_amount,
            'ref' => $ref,
            'wallet_address' => $request->wallet_address,
            'status' => 'pending',
        ];

        return response()->json(['withdrawal' => $withdrawalData, 'message' => 'Withdrawal initiated successfully']);
    }

    // withdrawal call back
    public function withdrawalCallback()
    {

        $ipn_secret = env('NP_SECRET_KEY');

        $error_msg = "Unknown error";
        $auth_ok = false;
        $request_data = null;

        if (request()->header('x-nowpayments-sig')) {
            $received_hmac = request()->header('x-nowpayments-sig');
            $request_json = request()->getContent();
            $request_data = json_decode($request_json, true);
            ksort($request_data);
            $sorted_request_json = json_encode($request_data);

            if ($request_json !== false && !empty($request_json)) {
                // file_put_contents(base_path('np_callback.json'), $request_json);
                $hmac = hash_hmac("sha512", $sorted_request_json, $ipn_secret);

                if ($hmac == $received_hmac) {
                    $auth_ok = true;
                } else {
                    $error_msg = 'HMAC signature does not match';
                    
                }

                $auth_ok = true;
            } else {
                $error_msg = 'Error reading POST data';
            }
        } else {
            $error_msg = 'No HMAC signature sent.';
        }

        // Log::error($error_msg);
        if ($auth_ok && $request_data != null) {

            // file_put_contents(base_path('np.json'), $request_json);
            $resp = json_decode($request_json);

            $status = $resp->status;
            $ref = 'trx-' . $resp->batch_withdrawal_id;


            //get the withdrawal
            $withdrawal = Withdrawal::where('ref', $ref)->where('status', 'pending')->first();
            if (!$withdrawal) {
                // Log::error('Not found or processed');
                return 'Not found or processed';
            }

            $status = strtolower($status);
            if ($status == 'finished') {
                $update = Withdrawal::find($withdrawal->id);
                $update->status = 'approved';
                $update->save();
                sendWithdrawalEmail($withdrawal);
                $message = "*New Withdrawal Notification* \n♻️Time: " . date('d-m-y H:i:s') .  " UTC \n♻️Currency: " . $resp->currency .  "\n♻️Amount: " . formatAmount($withdrawal->amount) .  "\n♻️Sent: " . $withdrawal->converted_amount .  $resp->currency . "\n♻️Address: " . $withdrawal->wallet_address .  "\n♻️Hash: " . $resp->hash .  "\n♻️Fee: " . formatAmount($withdrawal->fee) . "\n💃💃💃💃💃💃💃💃💃💃 \n🍷🍷🍷🍷🍷🍷🍷🍷🍷";
                        if (function_exists('sendMessageTelegram')) {
                            sendMessageTelegram($message);
                        }
            } elseif ($status == 'failed' || $status == 'rejected') {
                $update = Withdrawal::find($withdrawal->id);
                $update->status = 'rejected';
                $update->save();

                // credit the user
                $user = User::find($withdrawal->user_id);
                $new_bal = $user->balance + $withdrawal->amount;
                $user->balance = $new_bal;
                $user->save();
                
                recordNewTransaction($withdrawal->amount, $user->id, 'credit', 'Withdrawal reversal');
                sendWithdrawalEmail($withdrawal);
            }

            


            return true;
        } else {
            return false;
        }
    }
}
