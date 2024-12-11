<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KycRecord;
use App\Models\User;
use Illuminate\Http\Request;

class KycController extends Controller
{
    //return the kyc index page
    public function index()
    {
        $kyc_records_query = KycRecord::get();
        $kyc_summary = [
            'approved' => $kyc_records_query->where('status', 'approved')->count(),
            'rejected' => $kyc_records_query->where('status', 'rejected')->count(),
            'pending' => $kyc_records_query->where('status', 'pending')->count()
        ];
        $kyc_records =  KycRecord::orderBy('id', 'DESC')->paginate(site('pagination'));
        $page_title = 'KYC Records';
        

        return view('admin.kyc.index', compact(
            'page_title',
            'kyc_records',
            'kyc_summary'
            
        ));
    }

    // view kyc records
    public function viewKyc(Request $request)
    {
        $record = KycRecord::with('user')->where('id', $request->route('id'))->first();
        if (!$record) {
            return redirect('admin.kyc.index')->with('fail', 'KYC Record not found');
        }
        

        $page_title = $record->user->name . "'s KYC Record";

        return view('admin.kyc.view', compact(
            'page_title',
            'record'
        ));
    }


    // process kyc record
    public function process(Request $request)
    {
        $request->validate([
            'action' => 'required'
        ]);

        $action = $request->action;
        $document_id = $request->route('id');
        $record = KycRecord::find($document_id);
        if (!$record) {
            return response()->json(validationError('KYC record not found'), 422);
        }

        $user = User::find($record->user->id);

        if ($action == 'delete') {
            $record->delete();
            return response()->json(['message' => 'Record Deleted successfully']);
        } elseif ($action == 'approve') {
            $record->status = 'approved';
            $record->save();

            $user->kyc_verified_at = now();
            $user->save();
            return response()->json(['message' => 'Record approved successfully']);

        } elseif ($action == 'reject') {
            $record->status = 'rejected';
            $record->save();

            $user->kyc_verified_at = null;
            $user->save();
            return response()->json(['message' => 'Record rejected successfully']);

        } else {
            return response()->json(validationError('Unknown action'), 422);
        }
    }
}
