<?php

namespace App\Http\Middleware\Admin;

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

        

        if (site('admin_otp') == 1) {
            if (admin() && session()->has('admin-otp-verified')) {
                return redirect(route('admin.dashboard'))->with('fail', 'You are already logged in');
            }
        } else {
            if (admin()) {
                return redirect(route('admin.dashboard'))->with('fail', 'You are already logged in');
            }
        }
        return $next($request);
    }
}
