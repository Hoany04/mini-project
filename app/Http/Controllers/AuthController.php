<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\User;

class AuthController extends Controller
{
    // Login
    public function showFormLogin() {
        return view('auth.login');
    }

    public function login(Request $request) {
        $credentials  = $request->validate([
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string'],
        ]);

        if(Auth::attempt($credentials, $request->remember)) {
            $request->session()->regenerate();

            // Phan quyen chuyen huong
            if(Auth::user()->role && Auth::user()->role->name === 'Admin') {
                return redirect()->route('admin.home');
            } elseif (Auth::user()->role && Auth::user()->role->name === 'Customer') {
                return redirect()->route('client.home');
            }

            return redirect()->route('home');
        }

        return redirect()->back()->withErrors([
            'email' => 'Thong tin nguoi dung khong dung'
        ]);
    }

    public function showFormRegister() {
        return view('auth.register');
    }
    public function register(Request $request) {
        $data = $request->validate([
            'username' =>'required|string|max:255',
            'email' =>'required|string|email|max:255',
            'password' =>'required|string|min:8',
        ]);

        $user = User::create([
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role_id' => 3,
        ]);

        $user->profile()->create([]);

        Auth::login($user);

        return redirect()->intended('client/home');
    }

    public function logout(Request $request) {
        Auth::logout();
        return redirect('/login');
    }

    // Quen mk

    public function showFormForgot() {
        return view('auth.forgot-password');
    }
}
