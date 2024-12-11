<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Cache;
use App\Models\Setting;
use Illuminate\Support\Facades\View;

class GlobalVariablesMiddleware
{
    public function handle($request, Closure $next)
    {
        if (!file_exists(public_path('install.php'))) {
            $site = Cache::rememberForever('site', function () {
                return Setting::all();
            });
    
            $site = $site->keyBy('key');
    
            app()->instance('site', $site);
            View::share('site', $site);
        }

        return $next($request);
    }
}
