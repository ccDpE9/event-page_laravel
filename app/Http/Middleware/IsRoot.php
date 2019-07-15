<?php

namespace App\Http\Middleware;

use Closure;

class IsRoot
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
        if ($request->user()) {
            if ($request->user()->isRoot()) {
                return $next($request);
            }
        }

        return response()->json([
            "data" => "Unauthorized action."
        ], 401);
    }

    /*
    public function terminate($requeste, $response)
    {
        Log::debug($response->status());
    }
     */
}
