<?php

namespace App\Http\Controllers;

use App\Models\JadwalBimbingan;
use Illuminate\Http\Request;

class JadwalBimbinganController extends Controller
{
    public function index()
    {
        $jadwal = JadwalBimbingan::with(['mahasiswa', 'dosen'])->get();
        return view('jadwal.index', compact('jadwal'));
    }

    public function show($id)
    {
        $jadwal = JadwalBimbingan::with(['mahasiswa', 'dosen', 'penilaian'])->findOrFail($id);
        return view('jadwal.show', compact('jadwal'));
    }
} 