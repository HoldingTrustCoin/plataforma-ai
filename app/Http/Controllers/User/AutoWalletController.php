<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\AutoWallet;
use App\Models\DepositCoin;
use Illuminate\Http\Request;

class AutoWalletController extends Controller
{
    //create a new wallet
    public function create(Request $request)
    {

        $request->validate([
            'currency_code' => 'required',
            'wallet_address' => 'required'
        ]);

        
        // check if the wallets is allowed for withdrawal
        $currency = $request->currency_code;
        $coin = DepositCoin::where('code', $currency)->where('can_withdraw', 1)->first();
        if (!$coin) {
            return response()->json(validationError('The wallet you have selected is not allowed'), 422);
        }

        // check for regex
        $wallet_regex = $coin->wallet_regex; //^(0x)[0-9A-Fa-f]{40}$
        if (!preg_match('/' . $wallet_regex . '/', $request->wallet_address)) {
            return response()->json(validationError('The wallet you submitted is not valid for your selected coin'), 422);
        }

        // check if the user has previous submitted this wallet before
        $wallet_exists = AutoWallet::where('deposit_coin_id', $coin->id)->where('user_id', user()->id)->first();
        if ($wallet_exists) {
            return response()->json(validationError('You have submitted this wallet before, delete the previous wallet to add a new one'), 422);
        }
        
        $coin_id = $coin->id;
        

        $c_id = uniqid();

        //store the withdrawal wallet
       $wallet = new AutoWallet();
       $wallet->user_id = user()->id;
       $wallet->deposit_coin_id = $coin->id;
       $wallet->wallet_address = $request->wallet_address;
       $wallet->whitelisted = 0;
       $wallet->c_id = $c_id;
       $wallet->save();

        return response()->json(['message' => 'Wallet added successfully']);
    }
}
