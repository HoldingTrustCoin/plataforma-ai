<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    //index of all withdrawals
    public function index(Request $request)
    {
        $page_title = 'All Transactions';


        if ($request->s) {
            $transactions = Transaction::where('ref', 'LIKE', '%' . $request->s . '%')
                ->orderBy('id', 'DESC')
                ->paginate(site('pagination'));
        } else {
            $transactions = Transaction::orderBy('id', 'DESC')
                ->paginate(site('pagination'));
        }




        return view('admin.transactions.index', compact(
            'page_title',
            'transactions',
        ));
    }

    // delete transaction
    public function delete(Request $request)
    {
        $id = $request->route('id');
        $transaction = Transaction::find($id);
        if (!$transaction) {
            return response()->json(validationError('Transaction not found'), 422);
        }

        $transaction->delete();

        return response()->json(['message' => 'Transaction has been deleted succesfully']);
    }
}
