<?php

namespace App\Http\Middleware\User;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class G2faMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!env('DEMO_MODE')) {
            if (!session()->has('login.as.user')) {
                if (session()->get('g2fa') !== 1 && user()->g2fa == 1) {
                    return redirect(route('user.g2fa.index'))->with('fail', 'Verify 2FA');
                }
            }
        }
        return $next($request);
    }
}
