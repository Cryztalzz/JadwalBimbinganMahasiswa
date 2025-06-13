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

        // Coba login sebagai admin dengan username
        if (Auth::attempt(['username' => $login, 'password' => $password])) {
            $request->session()->regenerate();
            return redirect()->route('admin.dashboard');
        }

        // Coba login sebagai dosen dengan NIP
        $dosen = \App\Models\Dosen::where('nip', $login)->first();
        if ($dosen && Auth::attempt(['id' => $dosen->user_id, 'password' => $password])) {
            $request->session()->regenerate();
            return redirect()->route('dosen.dashboard');
        }

        // Coba login sebagai mahasiswa dengan NIM
        $mahasiswa = \App\Models\Mahasiswa::where('nim', $login)->first();
        if ($mahasiswa && Auth::attempt(['id' => $mahasiswa->user_id, 'password' => $password])) {
            $request->session()->regenerate();
            return redirect()->route('mahasiswa.dashboard');
        }

        return back()->withErrors([
            'login' => 'Username/NIP/NIM atau password salah.',
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