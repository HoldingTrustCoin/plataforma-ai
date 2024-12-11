<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Deposit;
use App\Models\User;
use Illuminate\Http\Request;

class DepositController extends Controller
{
    //return the kyc index page
    public function index(Request $request)
    {
        $deposit_query = Deposit::get();
        $summary = [
            'finished' => $deposit_query->where('status', 'finished')->sum('amount'),
            'expired' => $deposit_query->where('status', 'expired')->sum('amount'),
            'waiting' => $deposit_query->where('status', 'waiting')->sum('amount')
        ];

        if ($request->s) {
                $deposits =  Deposit::with(['user', 'depositCoin'])->where('ref', 'LIKE', '%' . $request->s . '%')->orderBy('id', 'DESC')->paginate(site('pagination'));
        } else {
            $deposits =  Deposit::with(['user', 'depositCoin'])->orderBy('id', 'DESC')->paginate(site('pagination'));
        }


        
        $page_title = 'All Deposits';
        

        return view('admin.deposits.index', compact(
            'page_title',
            'deposits',
            'summary'
            
        ));
    }

    // view kyc records
    public function viewDeposit(Request $request)
    {
        $deposit = Deposit::where('id', $request->route('id'))->first();
        if (!$deposit) {
            abort(404);
        }


        $depositData = [
            'amount' => $deposit->amount,
            'fee' => $deposit->fee,
            'currency' => $deposit->currency,
            'converted_amount' => $deposit->converted_amount,
            'ref' => $deposit->ref,
            'network' => $deposit->network,
            'valid_until' => $deposit->valid_until,
            'payment_id' => $deposit->payment_id,
            'payment_wallet' => $deposit->payment_wallet,
            'status' => $deposit->status,
            'id' => $deposit->id
        ];
        
        return response()->json(['deposit' => $depositData]);
    }


    // process kyc record
    public function process(Request $request)
    {
        $request->validate([
            'action' => 'required'
        ]);

        $action = $request->action;
        $id = $request->route('id');
        $deposit = Deposit::find($id);
        if (!$deposit) {
            return response()->json(validationError('Deposit not found'), 422);
        }

        $user = User::find($deposit->user->id);

        if ($action == 'delete') {
            $deposit->delete();
            return response()->json(['message' => 'Deposit Deleted successfully']);
        } elseif ($action == 'approve') {
            $is_processed = processDeposit($id, 'approve');
            if ($is_processed) {
                return response()->json(['message' => 'Deposit approved successfully']);
            } else {
                return response()->json(validationError('Failed to process deposit'));
            }
            

        } elseif ($action == 'reject') {
           
            $is_processed = processDeposit($id, 'reject');
            if ($is_processed) {
                return response()->json(['message' => 'Deposit rejected successfully']);
            } else {
                return response()->json(validationError('Failed to process deposit'));
            }

        } else {
            return response()->json(validationError('Unknown action'), 422);
        }
    }
}