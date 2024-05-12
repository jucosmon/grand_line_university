<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $userType = session('user_type'); // Fetch 'user_type' directly from the session

        if (auth()->check() && $userType == 'admin') {
            return $next($request);
        }

        abort(403, 'Unauthorized');
    }
}
