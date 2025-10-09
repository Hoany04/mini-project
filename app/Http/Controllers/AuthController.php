<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
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

    public function sendResetLink(Request $request) {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $token = Str::random(64);

        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $request->email],
            ['token' => $token, 'created_at' =>now()]
        );

        $link = route('password.reset', $token). '?email=' . urlencode($request->email);

        // Gui mail
        Mail::raw("Nhấn vào link để đặt lại mật khẩu: $link", function ($message) use ($request) {
            $message->to($request->email)->subject('Đặt lại mật khẩu');
        });

        return back()->with('Da gui link dat lai mk den email cua bn');
    }

    public function showFormReset($token) {
        return view('auth.reset-password', ['token' => $token, 'email' => request('email')]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|confirmed|min:6',
            'token' => 'required'
        ]);

        $tokenData = DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->where('token', $request->token)
            ->first();

        if (!$tokenData) {
            return back()->withErrors(['token' => 'Mã đặt lại không hợp lệ hoặc đã hết hạn.']);
        }

        User::where('email', $request->email)->update([
            'password' => Hash::make($request->password)
        ]);

        DB::table('password_reset_tokens')->where('email', $request->email)->delete();

        return redirect()->route('login')->with('success', 'Đặt lại mật khẩu thành công! Vui lòng đăng nhập lại.');
    }
}
