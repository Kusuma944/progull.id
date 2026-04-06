<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function registerForm() {
        return view('auth.register');
    }

    public function register(Request $request) {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect('/login');
    }

    public function loginForm() {
        return view('auth.login');
    }

    public function login(Request $request) {
    if (Auth::attempt($request->only('email','password'))) {
        return redirect()->route('admin.dashboard'); // redirect ke halaman admin
    }
    return back();
}


    public function logout() {
        Auth::logout();
        return redirect('/login');
    }
}
