<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class OtpController extends Controller
{
    public function resend()
    {
        Log::error(request()->input());
        sendOtp(admin()->email, null, true);

        return response()->json([
            "message" => "OTP Code has been resent to your registered admin email"
        ]);
    }
}
