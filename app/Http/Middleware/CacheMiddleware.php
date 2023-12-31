<?php

namespace App\Http\Middleware;

use App;
use Cache;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CacheMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the environment is 'production' or 'staging'
        if (App::environment(['production', 'staging'])) {
            $cacheKey = 'pokemon_' . md5($request->getUri());

            if (Cache::has($cacheKey)) {
                $cachedResponse = Cache::get($cacheKey);
                return response()->json(json_decode(strval($cachedResponse)));
            }

            // default response
            $response = $next($request);

            // cache response
            Cache::put($cacheKey, $response->getContent(), 1440);

            return $response;
        }

        // If not in 'production' or 'staging', handle the request normally
        return $next($request);
    }
}
