<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'login' => ['required', 'string'],
            'password' => ['required'],
        ]);

        $login = $request->input('login');
        $password = $request->input('password');

        // Coba login dengan username
        if (Auth::attempt(['username' => $login, 'password' => $password])) {
            $user = Auth::user();
            $request->session()->regenerate();

            // Redirect berdasarkan role
            switch ($user->role) {
                case 'admin':
                    return redirect()->intended(route('admin.dashboard'));
                case 'dosen':
                    return redirect()->intended(route('dosen.dashboard'));
                case 'mahasiswa':
                    return redirect()->intended(route('mahasiswa.dashboard'));
                default:
                    Auth::logout();
                    return back()->withErrors([
                        'login' => 'Role tidak valid.',
                    ])->onlyInput('login');
            }
        }

        return back()->withErrors([
            'login' => 'Username atau password salah.',
        ])->onlyInput('login');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}