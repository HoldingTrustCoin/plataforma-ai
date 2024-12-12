<?php

namespace App\Http\Middleware\User;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class NoAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        

        if (site('user_otp') == 1) {
            if (user() && session()->has('login-otp')) {
                return redirect(route('user.dashboard'))->with('fail', 'You are already logged in');
            }
        } else {
            if (user()) {
                return redirect(route('user.dashboard'))->with('fail', 'You are already logged in');
            }
        }
        return $next($request);
    }
}
