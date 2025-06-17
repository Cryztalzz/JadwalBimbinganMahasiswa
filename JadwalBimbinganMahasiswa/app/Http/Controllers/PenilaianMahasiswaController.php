<?php

namespace App\Http\Controllers;

use App\Models\JadwalBimbingan;
use App\Models\PenilaianMahasiswa;
use Illuminate\Http\Request;

class PenilaianMahasiswaController extends Controller
{
    public function create($id_jadwal)
    {
        $jadwal = JadwalBimbingan::with(['mahasiswa', 'dosen'])
            ->findOrFail($id_jadwal);

        // Pastikan hanya mahasiswa yang terkait yang bisa memberikan penilaian
        if ($jadwal->id_mahasiswa != auth()->user()->mahasiswa->id_mahasiswa) {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses untuk memberikan penilaian');
        }

        // Pastikan jadwal sudah selesai
        if ($jadwal->status !== 'selesai') {
            return redirect()->back()->with('error', 'Jadwal harus selesai terlebih dahulu');
        }

        // Pastikan belum ada penilaian
        if ($jadwal->penilaianMahasiswa) {
            return redirect()->back()->with('error', 'Penilaian sudah diberikan');
        }

        return view('mahasiswa.penilaian.create', compact('jadwal'));
    }

    public function store(Request $request, $id_jadwal)
    {
        $request->validate([
            'kualitas_bimbingan' => 'required|string',
            'keterangan' => 'nullable|string'
        ]);

        $jadwal = JadwalBimbingan::findOrFail($id_jadwal);

        // Pastikan hanya mahasiswa yang terkait yang bisa memberikan penilaian
        if ($jadwal->id_mahasiswa != auth()->user()->mahasiswa->id_mahasiswa) {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses untuk memberikan penilaian');
        }

        // Pastikan jadwal sudah selesai
        if ($jadwal->status !== 'selesai') {
            return redirect()->back()->with('error', 'Jadwal harus selesai terlebih dahulu');
        }

        // Pastikan belum ada penilaian
        if ($jadwal->penilaianMahasiswa) {
            return redirect()->back()->with('error', 'Penilaian sudah diberikan');
        }

        try {
            PenilaianMahasiswa::create([
                'id_jadwal' => $id_jadwal,
                'kualitas_bimbingan' => $request->kualitas_bimbingan,
                'keterangan' => $request->keterangan
            ]);

            return redirect()->route('mahasiswa.dashboard')
                ->with('success', 'Penilaian berhasil disimpan');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat menyimpan penilaian: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function show($id_jadwal)
    {
        $jadwal = JadwalBimbingan::with(['mahasiswa', 'dosen', 'penilaianMahasiswa'])
            ->findOrFail($id_jadwal);

        if (!$jadwal->penilaianMahasiswa) {
            return redirect()->back()->with('error', 'Penilaian belum diberikan');
        }

        return view('mahasiswa.penilaian.show', compact('jadwal'));
    }
} 