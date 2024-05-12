<?php
namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Cookie;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Teacher;
use App\Models\Student;
use App\Models\User;


class LoginController extends Controller
{
    /*
    public function deleteCookies()
    {
        foreach ($_COOKIE as $name => $value) {
            Cookie::queue(Cookie::forget($name));
        }

        return redirect()->intended(route('home_page'));
    }
    */
    public function showLoginPage()
    {

        return view('login_page');
    }
    //
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'user_type' => 'required',
        ]);

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
                return back()->withErrors(['user_type' => 'Invalid user type']);
        }


        if ($user && $credentials['password'] === $user->password) {
            Auth::login($user);
            $request->session()->put('user_type', $request->user_type);
            //dd($credentials['email'], $credentials['password'], $user->password, $user->email);
            // Pass user type along with user data
            return redirect()->intended(route('home_page'));
        } else {
            //dd('invalid credentials');
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
