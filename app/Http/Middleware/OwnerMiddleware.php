<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OwnerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
//    public function handle(Request $request, Closure $next): Response
//    {
//        return $next($request);
//    }
    public function handle(Request $request, Closure $next)
    {
        if ($request->user() && $request->user()->role === 'owner') {
            return $next($request);
        }

        return response()->json(['message' => 'Unauthorized'], 403);
    }
}
