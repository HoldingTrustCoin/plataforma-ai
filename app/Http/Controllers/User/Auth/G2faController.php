<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PragmaRX\Google2FA\Google2FA;

class G2faController extends Controller
{
    // index
    public function index()
    {
        $page_title = '2FA';

        return view('user.auth.g2fa', compact(
            'page_title'
        ));
    }


    // g2fa
    public function g2fa(Request $request)
    {
        $request->validate([
            'otp' => 'required|numeric'
        ]);

        

        $google2fa = new Google2FA();
        $valid = $google2fa->verifyKey(user()->g2fa_secret, $request->otp);
        if ($valid) {
            session()->put('g2fa', 1);
            $message = '2FA Verified';
            return response()->json(['message' => $message]);
        }

        return response()->json(validationError('Incorrect or expired 2fa code'), 422);
    }
}
