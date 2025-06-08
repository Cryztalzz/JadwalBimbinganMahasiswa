<?php

namespace App\Http\Controllers;

use App\Models\JadwalBimbingan;
use App\Models\Mahasiswa;
use App\Models\Dosen;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    public function index()
    {
        $jadwal = JadwalBimbingan::with(['mahasiswa', 'dosen'])->get();
        return view('jadwal.index', compact('jadwal'));
    }

    public function create()
    {
        $mahasiswa = Mahasiswa::all();
        $dosen = Dosen::all();
        return view('jadwal.create', compact('mahasiswa', 'dosen'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'mahasiswa_id' => 'required|exists:mahasiswa,id',
            'dosen_id' => 'required|exists:dosen,id',
            'tanggal' => 'required|date',
            'waktu_mulai' => 'required',
            'waktu_selesai' => 'required',
            'topik' => 'required',
            'status' => 'required|in:menunggu,diterima,ditolak,selesai'
        ]);

        JadwalBimbingan::create($request->all());
        return redirect()->route('jadwal.index')->with('success', 'Jadwal bimbingan berhasil ditambahkan');
    }

    public function show(JadwalBimbingan $jadwal)
    {
        return view('jadwal.show', compact('jadwal'));
    }

    public function edit(JadwalBimbingan $jadwal)
    {
        $mahasiswa = Mahasiswa::all();
        $dosen = Dosen::all();
        return view('jadwal.edit', compact('jadwal', 'mahasiswa', 'dosen'));
    }

    public function update(Request $request, JadwalBimbingan $jadwal)
    {
        $request->validate([
            'mahasiswa_id' => 'required|exists:mahasiswa,id',
            'dosen_id' => 'required|exists:dosen,id',
            'tanggal' => 'required|date',
            'waktu_mulai' => 'required',
            'waktu_selesai' => 'required',
            'topik' => 'required',
            'status' => 'required|in:menunggu,diterima,ditolak,selesai'
        ]);

        $jadwal->update($request->all());
        return redirect()->route('jadwal.index')->with('success', 'Jadwal bimbingan berhasil diperbarui');
    }

    public function destroy(JadwalBimbingan $jadwal)
    {
        $jadwal->delete();
        return redirect()->route('jadwal.index')->with('success', 'Jadwal bimbingan berhasil dihapus');
    }
} 