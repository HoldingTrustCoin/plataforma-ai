<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\P2p;
use App\Models\User;
use Illuminate\Http\Request;

class P2pController extends Controller
{
    //index of all withdrawals
    public function index(Request $request)
    {
        $page_title = 'My P2p Transfers';

        if ($request->s) {
            $transfers = P2p::where('sender_id', user()->id)
                ->orWhere('receiver_id', user()->id)
                ->where('ref', 'LIKE', '%' . $request->s . '%')
                ->orderBy('id', 'DESC')
                ->paginate(site('pagination'));

        } else {
            $transfers = P2p::where('sender_id', user()->id)
                ->orWhere('receiver_id', user()->id)
                ->orderBy('id', 'DESC')
                ->paginate(site('pagination'));
        }



        return view('user.p2p.index', compact(
            'page_title',
            'transfers',
        ));
    }


    // retrieve the user
    public function getUser(Request $request)
    {
        $request->validate([
            'username' => 'required'
        ]);
        $user = User::where('username', $request->username)->first();

        if ($user) {
            return response()->json(['name' => $user->name]);
        }

        return response()->json(validationError('User not found'), 422);
    }



    //new deposit 
    public function newTransfer(Request $request)
    {

        $request->validate([
            'amount' => 'required|numeric',
            'username' => 'required',
        ]);

        //check min and max
        $amount_before_fee = $request->amount;
        
        $fee = site('transfer_fee') / 100 * $amount_before_fee;
        $amount =  $amount_before_fee + $fee;
        if ($amount_before_fee < site('min_transfer') || $amount_before_fee > site('max_transfer')) {
            return response()->json(validationError('Min or max transfer amount not met'), 422);
        }

        //check for available balance
        if (user()->balance < $amount) {
            return response()->json(validationError('Insufficient balance'), 422);
        }

        $receiver = User::where('username', $request->username)->first();
        if (!$receiver) {
            return response()->json(validationError('User not found'), 422);
        }

        
        //debit the user
        $debit = User::find(user()->id);
        $debit->balance = user()->balance - $amount;
        $debit->save();

        $ref = uniqid('trx-');


        //log transaction
        recordNewTransaction($amount, user()->id, 'debit', 'Tranfer to ' . $receiver->username);


        // credit the recever
        $credit = User::find($receiver->id);
        $credit->balance = $receiver->balance + $amount_before_fee;
        $credit->save();

        //log transaction
        recordNewTransaction($amount_before_fee, $receiver->id, 'credit', 'Tranfer from ' . user()->username);

        //store the transfer
        $transfer = new P2p();
        $transfer->sender_id = user()->id;
        $transfer->sender_name = user()->name;
        $transfer->receiver_id = $receiver->id;
        $transfer->receiver_name = $receiver->name;
        $transfer->ref = $ref;
        $transfer->amount = $amount_before_fee;
        $transfer->fee = $fee;
        $transfer->save();
        

        // Notify new withdrawal
        // sendWithdrawalEmail($withdrawal);

        return response()->json(['message' => 'Transfer successful']);
    }
}
