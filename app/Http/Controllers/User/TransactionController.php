<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    //index of all withdrawals
    public function index(Request $request)
    {
        $page_title = 'My Transactions';


        if ($request->s) {
            $transactions = user()
                ->transactions()
                ->where('ref', 'LIKE', '%' . $request->s . '%')
                ->orderBy('id', 'DESC')
                ->paginate(site('pagination'));
        } else {
            $transactions = user()
                ->transactions() 
                ->orderBy('id', 'DESC')
                ->paginate(site('pagination'));
        }

        

        
        return view('user.transactions.index', compact(
            'page_title',
            'transactions',
        ));
    }




}
