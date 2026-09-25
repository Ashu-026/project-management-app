<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;



class AuthController extends Controller
{
    public function login(Request $request)
    {
        return view('Auth.login');
    }
    public function authenticate(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email',
            "password" => 'required',
        ]);
        if (Auth::attempt($data)) {
            $request->session()->regenerate();
            return redirect('/dashboard');
        }
        return back()->withErrors([
            'email' => 'Invalid credentials',
        ]);
    }
    // logout User
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
    // Register User
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
        ]);
        $user = new User;
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->password = Hash::make($validated['password']);
        $user->save();
        return redirect('/login')->with('success', 'User added successfully.');
    }

    // profile page 
    public function profile()
    {
        $user = Auth::user();
        return view('profile.profile', compact('user'));
    }
    public function updateProfile(Request $request)
    {
        /** @var User $user */
        $user = Auth::user();
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
        ]);
        if ($request->filled('new_password')) {
            if ($request->new_password === $request->confirm_new_password) {
                $validated['password'] = $request->new_password;
            }
        }
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        if (isset($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }
        $user->save();
        return back()->with('success', 'Profile updated successfully.');
    }
}
