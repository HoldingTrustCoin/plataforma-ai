<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\P2p;
use Illuminate\Http\Request;

class P2pController extends Controller
{
    //index of all withdrawals
    public function index(Request $request)
    {
        $page_title = 'All Transfer';


        if ($request->s) {
            $transfers = P2p::where('ref', 'LIKE', '%' . $request->s . '%')
                ->orderBy('id', 'DESC')
                ->paginate(site('pagination'));
        } else {
            $transfers = P2p::orderBy('id', 'DESC')
                ->paginate(site('pagination'));
        }




        return view('admin.transfers.index', compact(
            'page_title',
            'transfers',
        ));
    }

    // delete transaction
    public function delete(Request $request)
    {
        $id = $request->route('id');
        $transaction = P2p::find($id);
        if (!$transaction) {
            return response()->json(validationError('Transfer not found'), 422);
        }

        $transaction->delete();

        return response()->json(['message' => 'P2p Transfer has been deleted succesfully']);
    }
}
