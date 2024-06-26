<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class HomePageController extends Controller
{

    public function index(Request $request)
    {

        if (Auth::check()) {
            $userType = $request->session()->get('user_type');

            // Redirect based on user type
            switch ($userType) {
                case 'admin':
                    // Redirect admin to the admin home page
                    return view('home_page');
                case 'teacher':
                    // Redirect teacher to the teacher dashboard or another page
                    return view('pages.teacher.home');
                case 'student':
                    // Redirect student to the student home page
                    return view('pages.student.home');
                default:
                    // Handle other user types or unauthorized access
                    return redirect()->route('login')->with('error', 'Unauthorized access');
            }
        } else {
            // User is not authenticated, redirect to login page
            return redirect()->route('login');
        }
    }
}
