<?php
namespace App\Http\Controllers;

//use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class HomePageController extends Controller
{

    public function index()
    {
        /*
        dd("heyu");
        $user = Auth::user();

        // Check if the user is authenticated
        if ($user) {
            // Redirect based on user type
            switch ($user->user_type) {
                case 'admin':
                    // Redirect admin to the admin home page
                    return view('home_page'); // Assuming 'home_page.blade.php' is your admin home page
                case 'teacher':
                    // Redirect teacher to the teacher dashboard or another page
                    return view('teacher.home_page'); // Assuming 'STUDENT.home_page.blade.php' is your teacher home page
                case 'student':
                    // Redirect student to the student home page
                    return view('student.home_page');
                default:
                    dd("unauthorize user");
                    // Handle other user types or unauthorized access

                    return redirect()->route('login');
            }
        } else {
            // User is not authenticated, redirect to login page
            dd("user is not authenticated");
           return redirect()->route('login');
        }
        */
        return view('home_page');
    }
}
