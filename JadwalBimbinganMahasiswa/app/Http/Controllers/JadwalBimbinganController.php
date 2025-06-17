<?php

namespace App\Http\Controllers;

use App\Models\JadwalBimbingan;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JadwalBimbinganController extends Controller
{
    public function index()
    {
        $mahasiswa = Mahasiswa::where('email', Auth::user()->email)->first();
        
        if (!$mahasiswa) {
            return redirect()->route('login')->with('error', 'Data mahasiswa tidak ditemukan');
        }

        $jadwal = JadwalBimbingan::where('nim', $mahasiswa->nim)
            ->with(['dosen', 'mahasiswa'])
            ->latest()
            ->get();

        $dosen = Dosen::all();

        // Debugging: memeriksa data jadwal
        // dd($jadwal->toArray());

        return view('mahasiswa.jadwal', compact('jadwal', 'dosen'));
    }

    public function create()
    {
        $dosen = Dosen::all();
        return view('mahasiswa.jadwal-create', compact('dosen'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'dosen_id' => 'required',
            'tanggal' => 'required|date',
            'waktu_mulai' => 'required',
            'waktu_selesai' => 'required',
            'topik' => 'required',
        ]);

        $mahasiswa = Mahasiswa::where('email', Auth::user()->email)->first();
        
        if (!$mahasiswa) {
            return redirect()->back()->with('error', 'Data mahasiswa tidak ditemukan');
        }

        JadwalBimbingan::create([
            'nim' => $mahasiswa->nim,
            'id_dosen' => $request->dosen_id,
            'tanggal' => $request->tanggal,
            'waktu_mulai' => $request->waktu_mulai,
            'waktu_selesai' => $request->waktu_selesai,
            'topik' => $request->topik,
            'status' => 'menunggu_persetujuan'
        ]);

        return redirect()->route('jadwal-bimbingan.index')
            ->with('success', 'Jadwal bimbingan berhasil dibuat');
    }

    public function cancel($id)
    {
        $jadwal = JadwalBimbingan::findOrFail($id);
        $mahasiswa = Mahasiswa::where('email', Auth::user()->email)->first();
        
        // Pastikan hanya mahasiswa yang membuat jadwal yang bisa membatalkan
        if ($jadwal->nim != $mahasiswa->nim) {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses untuk membatalkan jadwal ini');
        }

        // Hanya jadwal yang masih menunggu yang bisa dibatalkan
        if ($jadwal->status !== 'menunggu_persetujuan') {
            return redirect()->back()->with('error', 'Jadwal ini tidak dapat dibatalkan karena sudah diproses');
        }

        $jadwal->update(['status' => 'dibatalkan']);

        return redirect()->route('jadwal-bimbingan.index')
            ->with('success', 'Jadwal bimbingan berhasil dibatalkan');
    }

    public function show($id)
    {
        $jadwal = JadwalBimbingan::with(['mahasiswa', 'dosen', 'penilaian'])->findOrFail($id);
        return view('jadwal.show', compact('jadwal'));
    }
} 