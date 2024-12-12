<?php

namespace App\Http\Middleware\Admin;

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
        if (!admin()) {
            return redirect(route('admin.login'))->with('fail', 'Login to continue');
        } elseif (!session()->get('admin-otp-verified') && site('admin_otp') == 1 ) {
            if (!request()->routeIs('admin.resend-otp')){
                return redirect(route('admin.login'))->with('fail', 'Verify otp');
            }
        }
        return $next($request);
    }
}
