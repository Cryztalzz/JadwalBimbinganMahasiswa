<?php

namespace App\Http\Controllers;

use App\Models\PenilaianBimbingan;
use App\Models\JadwalBimbingan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PenilaianBimbinganController extends Controller
{
    public function create($id_jadwal)
    {
        $jadwal = JadwalBimbingan::with(['dosen', 'mahasiswa'])
            ->findOrFail($id_jadwal);
        
        // Cek apakah jadwal sudah selesai
        if ($jadwal->status !== 'selesai') {
            return redirect()->back()->with('error', 'Jadwal bimbingan belum selesai');
        }

        // Cek apakah sudah ada penilaian
        if ($jadwal->penilaianBimbingan) {
            return redirect()->back()->with('error', 'Penilaian sudah dilakukan');
        }

        return view('penilaian.create', compact('jadwal'));
    }

    public function store(Request $request, $id_jadwal)
    {
        $request->validate([
            'aktivitas_mahasiswa' => 'required|string',
            'keterangan' => 'nullable|string'
        ]);

        $jadwal = JadwalBimbingan::findOrFail($id_jadwal);
        
        // Pastikan hanya dosen yang terkait yang bisa memberikan penilaian
        if ($jadwal->id_dosen != auth()->user()->dosen->id_dosen) {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses untuk memberikan penilaian');
        }

        // Pastikan jadwal sudah selesai
        if ($jadwal->status !== 'selesai') {
            return redirect()->back()->with('error', 'Jadwal harus selesai terlebih dahulu');
        }

        // Pastikan belum ada penilaian
        if ($jadwal->penilaianBimbingan) {
            return redirect()->back()->with('error', 'Penilaian sudah diberikan');
        }

        PenilaianBimbingan::create([
            'id_jadwal' => $id_jadwal,
            'aktivitas_mahasiswa' => $request->aktivitas_mahasiswa,
            'keterangan' => $request->keterangan
        ]);

        return redirect()->back()->with('success', 'Penilaian berhasil disimpan');
    }

    public function show($id_jadwal)
    {
        $jadwal = JadwalBimbingan::with(['mahasiswa', 'dosen', 'penilaianBimbingan'])
            ->findOrFail($id_jadwal);
        
        if (!$jadwal->penilaianBimbingan) {
            return redirect()->back()->with('error', 'Penilaian belum diberikan');
        }

        return view('penilaian.show', compact('jadwal'));
    }

    public function riwayat()
    {
        $user = Auth::user();
        $penilaian = [];

        if ($user->hasRole('dosen')) {
            $penilaian = PenilaianBimbingan::with(['jadwalBimbingan.mahasiswa'])
                ->whereHas('jadwalBimbingan', function ($query) use ($user) {
                    $query->where('id_dosen', $user->dosen->id_dosen);
                })
                ->latest()
                ->get();
        } elseif ($user->hasRole('mahasiswa')) {
            $penilaian = PenilaianBimbingan::with(['jadwalBimbingan.dosen'])
                ->whereHas('jadwalBimbingan', function ($query) use ($user) {
                    $query->where('nim', $user->mahasiswa->nim);
                })
                ->latest()
                ->get();
        }

        return view('penilaian.riwayat', compact('penilaian'));
    }
} 