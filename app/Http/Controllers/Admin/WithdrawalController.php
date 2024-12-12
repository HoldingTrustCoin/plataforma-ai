<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AutoWallet;
use App\Models\User;
use App\Models\Withdrawal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WithdrawalController extends Controller
{
    //return the kyc index page
    public function index(Request $request)
    {
        $withdrawal_query = Withdrawal::get();
        $summary = [
            'approved' => $withdrawal_query->where('status', 'approved')->sum('amount'),
            'rejected' => $withdrawal_query->where('status', 'rejected')->sum('amount'),
            'pending' => $withdrawal_query->where('status', 'pending')->sum('amount')
        ];

        if ($request->s) {
            $withdrawals =  Withdrawal::with(['user', 'depositCoin'])->where('ref', 'LIKE', '%' . $request->s . '%')->orderBy('id', 'DESC')->paginate(site('pagination'));
        } else {
            $withdrawals =  Withdrawal::with(['user', 'depositCoin'])->orderBy('id', 'DESC')->paginate(site('pagination'));
        }



        $page_title = 'All Withdrawals';

        $balances = [];
        $balance_error = null;

        $api_key = env('NP_API_KEY');
        $response = Http::withHeaders([
            'x-api-key' => $api_key,
        ])->get('https://api.nowpayments.io/v1/balance');

        if (!$response->successful()) {
            $response = json_decode($response->body());
            $balance_error = $response->message ?? 'Failed to retrieve balance';
        } else {
            $balances = $response->json();
        }

        if ($request->w) {
            $auto_wallets =  AutoWallet::with(['user', 'depositCoin'])->where('wallet_address', 'LIKE', '%' . $request->w . '%')->orderBy('id', 'DESC')->paginate(site('pagination'));
        } else {
            $auto_wallets =  AutoWallet::with(['user', 'depositCoin'])->orderBy('id', 'DESC')->paginate(site('pagination'));
        }



        return view('admin.withdrawals.index', compact(
            'page_title',
            'withdrawals',
            'summary',
            'balances',
            'balance_error',
            'auto_wallets'

        ));
    }

    // view kyc records
    public function viewWithdrawal(Request $request)
    {
        $withdrawal = Withdrawal::with('depositCoin')->where('id', $request->route('id'))->first();
        if (!$withdrawal) {
            abort(404);
        }


        $withdrawalData = [
            'amount' => $withdrawal->amount,
            'fee' => $withdrawal->fee,
            'currency' => $withdrawal->depositCoin->code,
            'converted_amount' => $withdrawal->converted_amount,
            'ref' => $withdrawal->ref,
            'network' => $withdrawal->depositCoin->network ?? $withdrawal->depositCoin->code,
            'payment_wallet' => $withdrawal->wallet_address,
            'status' => $withdrawal->status,
            'id' => $withdrawal->id
        ];

        return response()->json(['withdrawal' => $withdrawalData]);
    }


    // process kyc record
    public function process(Request $request)
    {
        $request->validate([
            'action' => 'required'
        ]);

        $action = $request->action;
        $id = $request->route('id');
        $withdrawal = Withdrawal::find($id);
        if (!$withdrawal) {
            return response()->json(validationError('Deposit not found'), 422);
        }

        $user = User::find($withdrawal->user->id);

        if ($action == 'delete') {
            $withdrawal->delete();
            return response()->json(['message' => 'Withdrawal Deleted successfully']);
        } elseif ($action == 'approve') {
            $withdrawal->status = 'approved';
            $withdrawal->save();

            sendWithdrawalEmail($withdrawal);
            return response()->json(['message' => 'Withdrawal request was approved']);
        } elseif ($action == 'reject') {
            $withdrawal->status = 'rejected';
            $withdrawal->save();

            //credit the user back
            $new_balance = $user->balance + $withdrawal->amount;
            $user->balance = $new_balance;
            $user->save();
            recordNewTransaction($withdrawal->amount, $user->id, 'credit', 'Withdrawal refunded');
            sendWithdrawalEmail($withdrawal);
            // send email
            return response()->json(['message' => 'Withdrawal request was declined']);
        }

        return response()->json(validationError('Unknown action'), 422);
    }


    //delete auto wallets
    public function deleteWallet(Request $request)
    {
        $wallet = AutoWallet::find($request->route('id'));
        if ($wallet) {
            $wallet->delete();
            return response()->json(['message' => 'Wallet Deleted successfully']);
        } else {
            return response()->json(validationError('Failed to delete wallet'), 422);
        }
    }
}
