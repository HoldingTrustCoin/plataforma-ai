<?php

namespace App\Http\Middleware\User;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class KycAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!session()->has('login.as.user')) {
            if (!user()->kyc_verified_at && site('kyc_v') == 1) {
                //return the kyc set up page
                return redirect(route('user.kyc.index'))->with('fail', 'KYC Verification required');
            }
        }
        
        return $next($request);
    }
}
