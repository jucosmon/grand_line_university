<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AdminController extends Controller
{
     public function showProfile()
    {
        $user = User::find(Auth::id());// Assuming the authenticated user is the user
        return view('pages.user.profile', compact('user'));
    }

    public function editProfileForm()
    {
        $user = User::find(Auth::id()); // Assuming the authenticated user is the user
        return view('pages.user.edit_profile', compact('user'));
    }

    public function editProfile(Request $request)
    {
        $user = User::find(Auth::id()); // Assuming the authenticated user is the user

        $validatedData = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string',
            //'password' => 'required|string', // Add password validation
        ]);

        // Update profile fields
        $user->update($validatedData);
        $user->save();

        return redirect()->route('user.profile')->with('success', 'Profile updated successfully.');
    }



}
