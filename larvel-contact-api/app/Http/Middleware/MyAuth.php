<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class MyAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $accessKeys = ["abc","def"];
        if(!$request->has("key") || !in_array($request->key,$accessKeys))
        {
            return response()->json([
                "message" => "no data",
                "errors" => "key ma par bu"
            ],403);
        }
        return $next($request);
    }
}
