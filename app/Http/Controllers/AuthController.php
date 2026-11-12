<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    // ===== REGISTER =====
    public function registerForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'customer', // pendaftar publik selalu customer
        ]);

        return redirect('/login');
    }

    // ===== LOGIN =====
    public function loginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if (Auth::attempt($credentials)) {
            // akun yang diblokir admin tidak boleh masuk
            if (! $request->user()->is_active) {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return back()
                    ->withErrors(['email' => 'Akun kamu diblokir. Hubungi admin.'])
                    ->onlyInput('email');
            }

            $request->session()->regenerate();

            // Arahkan sesuai role
            if ($request->user()->isAdmin()) {
                return redirect()->route('admin.dashboard');
            }
            return redirect('/catalog');
        }

        return back()
            ->withErrors(['email' => 'Email atau password salah.'])
            ->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }

    // ===== FORGOT PASSWORD =====
    public function forgotPasswordForm()
    {
        return view('auth.forgot-password');
    }

    public function sendResetLink(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $status = Password::sendResetLink($request->only('email'));

        if ($status === Password::RESET_LINK_SENT) {
            return back()->with('status', 'Link reset password sudah dikirim. Silakan cek email kamu.');
        }

        $messages = [
            Password::INVALID_USER => 'Email tidak terdaftar.',
            Password::RESET_THROTTLED => 'Terlalu sering mencoba. Tunggu sebentar lalu coba lagi.',
        ];

        return back()
            ->withErrors(['email' => $messages[$status] ?? 'Gagal mengirim link reset password.'])
            ->onlyInput('email');
    }

    // ===== RESET PASSWORD =====
    public function resetPasswordForm(Request $request, string $token)
    {
        return view('auth.reset-password', [
            'token' => $token,
            'email' => $request->query('email'),
        ]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                    'remember_token' => Str::random(60),
                ])->save();

                event(new PasswordReset($user));
            }
        );

        if ($status === Password::PASSWORD_RESET) {
            return redirect('/login')->with('status', 'Password berhasil direset. Silakan login.');
        }

        $messages = [
            Password::INVALID_TOKEN => 'Token reset tidak valid atau sudah kedaluwarsa.',
            Password::INVALID_USER => 'Email tidak terdaftar.',
        ];

        return back()
            ->withErrors(['email' => $messages[$status] ?? 'Gagal mereset password.'])
            ->onlyInput('email');
    }
}
