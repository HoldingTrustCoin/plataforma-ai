<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OtpController extends Controller
{
    public function resend()
    {
        sendOtp(user()->email);

        return response()->json([
            "message" => "OTP Code has been resent to your registered email"
        ]);
    }
}
