<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    //show login form
    public function login()
    {
        $page_title = 'Admin Login';

        return view('admin.auth.login', compact(
            'page_title',
        ));

    }

    //validate the login form

    public function loginValidate()
    {
        $request = request();
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => 'Email is required',
        ]);

        //check if there an admin with the email
        $email = $request->email;
        $password = $request->password;
        $admin = Admin::where('email', $email)->first();

        $error = null;
        if(!$admin) {
            $error = 'Incorrect  email';
        } else {
            //check the password mataches
            if (!Hash::check($password, $admin->password)) {
                $error = 'Incorrect password';
            } else {
                //login the admin in
                session()->put('admin', $admin->id);
                //check if the login otp is required
                $message = 'Login successful, directing to dashboard';
                if (site('admin_otp') == 1) {
                    //send otp
                    $code = sendOtp($admin->email, null, true);
                    if (env('DEMO_MODE')) {
                        $message = 'Use otp code [' . $code . '] to complete login';  
                    }
                }

                return response()->json(
                    [
                        'message' => $message,
                        'verify' => site('admin_otp')
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
        if (!validateOtp($request->otp, admin()->email,  true)) {
            return response()->json(validationError('Invalid or expired otp'),422);
        }

        session()->put('admin-otp-verified', 1);

        return response()->json(['message' => 'Otp Code Verified. Redirecting to your dashboard']);
    }

    //logout
    public function logOut()
    {
        session()->pull('admin-otp-verified');
        session()->pull('admin');

        return response()->json(['message' => 'Logout successful, redirecting you']);
    }
}