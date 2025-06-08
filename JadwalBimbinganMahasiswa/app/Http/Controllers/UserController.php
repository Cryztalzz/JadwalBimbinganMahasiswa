<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        if ($user->role === 'dosen') {
            return view('dosen.dashboard');
        } else {
            return view('mahasiswa.dashboard');
        }
    }
}