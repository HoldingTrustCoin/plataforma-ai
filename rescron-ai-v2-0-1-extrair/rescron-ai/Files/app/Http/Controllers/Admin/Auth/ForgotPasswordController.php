<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ForgotPasswordController extends Controller
{
    public function index()
    {
        $page_title = 'Forgot Password';

        return view('admin.auth.forgot-password', compact(
            'page_title',
        ));
    }


    // validate password reset
    public function forgotPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $user = Admin::where('email', $request->email)->first();

        $message = 'There is a recent password reset request on your account. Use the otp code below to confirm the reset';
        if ($user){
            session()->put('admin-reset-email', $request->email);
            sendOtp($request->email, $message, true);
        }

        return response()->json(['message' => "Password reset request has been sent to your email"]);
    }


    // validate the reset
    public function forgotPasswordValidate(Request $request)
    {
        $request->validate([
            'otp' => 'required|numeric',
            'password' => 'required|confirmed'
        ]);

        $email = session()->get('admin-reset-email');
        if (!validateOtp($request->otp, $email, true)) {
            return response()->json(validationError('Invalid or expired OTP Code'), 422);
        }


        // update the password
        $user = Admin::where('email', $email)->first();
        if (!$user) {
            return response()->json(validationError('Email not correct'), 422);
        }
        
        $update = Admin::find($user->id);
        $update->password = Hash::make($request->password);
        $update->save();

        return response()->json(['message' => 'Password Changed successfully']);
    }
}
