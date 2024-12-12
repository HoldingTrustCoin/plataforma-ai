<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ForgotPasswordController extends Controller
{
    public function index()
    {
        $page_title = 'Forgot Password';

        return view('user.auth.forgot-password', compact(
            'page_title',
        ));
    }


    // validate password reset
    public function forgotPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $user = User::where('email', $request->email)->first();

        $message = 'There is a recent password reset request on your account. Use the otp code below to confirm the reset';
        if ($user){
            session()->put('reset-email', $request->email);
            sendOtp($request->email, $message);
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

        $email = session()->get('reset-email');
        if (!validateOtp($request->otp, $email)) {
            return response()->json(validationError('Invalid or expired OTP Code'), 422);
        }


        // update the password
        $user = User::where('email', $email)->first();
        if (!$user) {
            return response()->json(validationError('Email not correct'), 422);
        }
        
        $update = User::find($user->id);
        $update->password = Hash::make($request->password);
        $update->save();

        return response()->json(['message' => 'Password Changed successfully']);
    }
}
