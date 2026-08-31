<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Render forms
    public function showRegister()
    {
        return view('auth.register');
    }

    // Process Registration
    public function register(Request $request)
    {
        $credentials = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:4',
        ]);

        $existingUser = User::where('email', $credentials['email'])->first();

        if ($existingUser) {
            return back()
                ->withInput()
                ->with('error', 'This email is already registered. Please login or use another email.');
        }

        $user = User::create([
            'name' => $credentials['name'],
            'email' => $credentials['email'],
            'password' => Hash::make($credentials['password']),
        ]);

        return back()->with('success', 'Registration successful. Please login.');
    }


    //Render login
    public function showLogin()
    {
        // dd('LOGIN PAGE CONTROLLER');
        return view('auth.login');
    }

    // Process Login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            if (Auth::check()) {
                return redirect('/students')
                    ->with('warning', 'You are already logged in.');
            }
        }

        return back()->with('error', 'Invalid email or password.');
    }

    // Process Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
