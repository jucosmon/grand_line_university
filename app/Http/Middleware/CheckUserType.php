<?php

namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;

class CheckUserType
{
    public function handle(Request $request, Closure $next)
    {
        // Check if the user is authenticated
        if ($request->user()) {
            // Get the user type from the session
            $userType = session()->get('user_type');

            // Redirect based on the user type
            switch ($userType) {
                case 'admin':
                    return $request->is('admin*') ? $next($request) : redirect()->route('home_page');
                case 'teacher':
                    return $request->is('teacher*') ? $next($request) : redirect()->route('home_page');
                case 'student':
                    return $request->is('student*') ? $next($request) : redirect()->route('home_page');
                default:
                    return redirect()->route('home_page');
            }
        }

        // If the user is not authenticated, redirect to login
        return redirect()->route('login');
    }
}
