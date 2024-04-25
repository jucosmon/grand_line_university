<?php

namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckUserType
{
    public function handle(Request $request, Closure $next): Response
    {
        // Get the authenticated user
        $user = $request->user();

        // Check if the user is authenticated and has a user_type attribute
        if ($user && $user->user_type) {
            // Determine the user type and handle the request accordingly
            switch ($user->user_type) {
                case 'admin':
                    // Handle admin user
                    // For example, you can check if the requested route matches admin routes
                    if ($request->is('admin*')) {
                        return $next($request);
                    }
                    // Redirect admin to the admin home page
                    return redirect()->route('home_page');
                case 'teacher':
                    // Handle teacher user
                    // For example, you can check if the requested route matches teacher routes
                    if ($request->is('teacher*')) {
                        return $next($request);
                    }
                    // Redirect teacher to the teacher home page
                   return redirect()->route('home_page');
                case 'student':
                    // Handle student user
                    // For example, you can check if the requested route matches student routes
                    if ($request->is('student*')) {
                        return $next($request);
                    }
                    // Redirect student to the student home page
                    return redirect()->route('home_page');
            }
        }

        // If the user is not authenticated or doesn't have a user_type, redirect to login
       // dd('hakdog');
        return redirect()->route('home_page');
    }
}
