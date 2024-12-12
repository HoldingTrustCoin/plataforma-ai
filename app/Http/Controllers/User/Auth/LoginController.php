<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    //show login form
    public function login()
    {
        $page_title = 'Login';

        return view('user.auth.login', compact(
            'page_title',
        ));

    }

    //validate the login form

    public function loginValidate()
    {
        $request = request();
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ], [
            'email.required' => 'Email or Username is required',
        ]);

        //check if there is a user with such username
        $username_or_email = $request->email;
        $password = $request->password;
        $user = User::where('email', $username_or_email)->orWhere('username', $username_or_email)->first();

        $error = null;
        if(!$user) {
            $error = 'Incorrect username or email';
        } else {
            //check the password mataches
            if (!Hash::check($password, $user->password)) {
                $error = 'Incorrect password';
            } else {
                //login the user in
                session()->put('user', $user->id);
                //check if the login otp is required
                $message = 'Login successful, directing to dashboard';
                if (site('user_otp') == 1) {
                    //send otp
                    $code = sendOtp($user->email);
                    if (env('DEMO_MODE')) {
                        $message = 'Use otp code [' . $code . '] to complete login';  
                    }
                }

                return response()->json(
                    [
                        'message' => $message,
                        'verify' => site('user_otp')
                    ]
                );
            }
        }

        
        //return a failed login message
        return response()->json(validationError($error), 422);


        
    }

    //verify the user login
    public function loginVerify()
    {
        $request = request();
        $request->validate(
            [
                'otp' => 'required|numeric',
            ]
        );

        //check if otp is valid
        if (!validateOtp($request->otp, user()->email)) {
            return response()->json(validationError('Invalid or expired otp'),422);
        }

        session()->put('login-otp', 1);

        return response()->json(['message' => 'Otp Code Verified. Redirecting to your dashboard']);
    }

    //logout
    public function logOut()
    {
        session()->pull('login-otp');
        session()->pull('user');
        session()->pull('g2fa');

        return response()->json(['message' => 'Logout successful, redirecting you']);
    }
}