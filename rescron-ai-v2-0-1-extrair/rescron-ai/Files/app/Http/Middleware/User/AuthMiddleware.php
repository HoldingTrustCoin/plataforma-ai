<?php

namespace App\Http\Middleware\User;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!user()) {
            return redirect(route('user.login'))->with('fail', 'Login to continue');
        } else {
            if (!session()->has('login.as.user')) {
                // if the user is suspended while logged, force logout
                if (user()->status != 1) {
                    session()->flush();
                    return redirect(route('user.login'))->with('fail', 'Your account is suspended');
                } else {
                    if (!session()->get('login-otp') && site('user_otp') == 1) {
                        if (!request()->routeIs('user.resend-otp')) {
                            return redirect(route('user.login'))->with('fail', 'Verify otp');
                        }
                    }
                }
            }
        }
        return $next($request);
    }
}
