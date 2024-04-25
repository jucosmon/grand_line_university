<?php
namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Cookie;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Teacher;
use App\Models\Student;
use App\Models\User;
use Illuminate\Support\Facades\Log;


class LoginController extends Controller
{
    public function deleteCookies()
    {
        foreach ($_COOKIE as $name => $value) {
            Cookie::queue(Cookie::forget($name));
        }

        return redirect()->intended(route('home_page'));
    }
    public function showLoginPage()
    {
        return view('login_page');
    }
    //
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password', 'user_type');


        // Determine which table to search based on user_type
        switch ($credentials['user_type']) {
            case 'admin':
                $user = User::where('email', $credentials['email'])->first();
                break;
            case 'teacher':
                $user = Teacher::where('email', $credentials['email'])->first();
                break;
            case 'student':
                $user = Student::where('email', $credentials['email'])->first();
                break;
            default:
                return back()->withErrors(['email' => 'Invalid user type']);
        }

        if ($user) {
            // Check if the input password matches the password stored in the database
            if ($credentials['password'] == $user->password) {
                Auth::login($user);
                dump("Login successful");
                return redirect()->intended(route('home_page'));
        } else {
                dd("Invalid credentials"); // Dump error message to terminal
                return back()->withErrors(['email' => 'Invalid credentials']);
            }
        } else {
            dd("User not found"); // Dump error message to terminal
            return back()->withErrors(['email' => 'User not found']);
        }
    }
     // Define the logout() method as before
     public function logout(Request $request)
     {
         // Your logout logic here
     }
}
