<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Dosen;

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
            
            // Verifikasi bahwa user adalah dosen yang benar
            if ($user->role === 'dosen') {
                $dosen = Dosen::where('email', $user->email)->first();
                if (!$dosen) {
                    Auth::logout();
                    return back()->withErrors([
                        'login' => 'Data dosen tidak ditemukan.',
                    ])->onlyInput('login');
                }
            }
            
            $request->session()->regenerate();

            // Redirect berdasarkan role
            switch ($user->role) {
                case 'admin':
                    return redirect()->route('admin.dashboard');
                case 'dosen':
                    return redirect()->route('dosen.dashboard');
                case 'mahasiswa':
                    return redirect()->route('mahasiswa.dashboard');
                default:
                    Auth::logout();
                    return back()->withErrors([
                        'login' => 'Role tidak valid.',
                    ])->onlyInput('login');
            }
        }

        // Coba login dengan email
        if (Auth::attempt(['email' => $login, 'password' => $password])) {
            $user = Auth::user();
            
            // Verifikasi bahwa user adalah dosen yang benar
            if ($user->role === 'dosen') {
                $dosen = Dosen::where('email', $user->email)->first();
                if (!$dosen) {
                    Auth::logout();
                    return back()->withErrors([
                        'login' => 'Data dosen tidak ditemukan.',
                    ])->onlyInput('login');
                }
            }
            
            $request->session()->regenerate();

            // Redirect berdasarkan role
            switch ($user->role) {
                case 'admin':
                    return redirect()->route('admin.dashboard');
                case 'dosen':
                    return redirect()->route('dosen.dashboard');
                case 'mahasiswa':
                    return redirect()->route('mahasiswa.dashboard');
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