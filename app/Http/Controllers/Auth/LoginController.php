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

        if ($user && $credentials['password'] === $user->password) {
            Auth::login($user);

            // Pass user type along with user data
            return redirect()->intended(route('home_page'))->with('user_type', $credentials['user_type']);
        } else {
            return back()->withErrors(['email' => 'Invalid credentials']);
        }

    }

     // Define the logout() method as before
     public function logout(Request $request)
     {

            Auth::logout(); // Log the user out
            return redirect()->route('login_page'); // Redirect to the login page after logout


     }
}
