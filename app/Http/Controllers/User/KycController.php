<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\KycRecord;
use Illuminate\Http\Request;

class KycController extends Controller
{
    //return the kyc index page
    public function index()
    {
        $kyc_records = user()->kycRecords()->get();
        $page_title = 'KYC';

        if (!user()->name) {
            return redirect(route('user.profile.index'))->with('fail', 'Update your profile to proceed');
        }

        return view('user.kyc.index', compact(
            'page_title',
            'kyc_records'
        ));
    }

    //return the upload view
    public function create(Request $request) {

        //prevent multi records
        if (user()->kyc_verified_at) {
            return response()->json(validationError('KYC Verification previously completed'), 422);
        }

        //prevent multi records
        if (user()->kycRecords()->where('status', 'pending')->first()) {
            return response()->json(validationError('You have a pending KYC Document'), 422);
        }


        //if the user has uploaded kyc before
        $request->validate([
            'document_type' => 'required',
            'front' => 'required|mimes:png,jpg,jpeg|max:10240', // 10MB in kilobytes (KB)
            'back' => 'required_unless:document_type,passport|mimes:png,jpg,jpeg|max:10240',
            'selfie' => 'required|mimes:png,jpg,jpeg|max:10240',
        ]);

        


        $path = 'kyc';
        $front = uploadImage($request->file('front'), $path);
        $back = null;
        if ($request->hasFile('back')) {
            $back = uploadImage($request->file('back'), $path);
        }
        $selfie = uploadImage($request->file('selfie'), $path);

        $photos = [
            'front' => $front,
            'back' => $back,
            'selfie' => $selfie,
        ];
        //save the kyc record
        $kyc = new KycRecord();
        $kyc->user_id = user()->id;
        $kyc->document_type = $request->document_type;
        $kyc->photos = json_encode($photos);
        $kyc->status = 'pending';
        $kyc->save();

        
        sendKycMail($kyc);

        return response()->json(['message' => 'Kyc Documents submitted successfully']);
    }
}
