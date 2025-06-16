<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\JadwalBimbingan;
use App\Models\Dosen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MahasiswaController extends Controller
{
    public function index()
    {
        $mahasiswa = Mahasiswa::all();
        return view('mahasiswa.index', compact('mahasiswa'));
    }

    public function create()
    {
        return view('mahasiswa.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nim' => 'required|unique:mahasiswa',
            'nama' => 'required',
            'email' => 'required|email|unique:mahasiswa',
            'password' => 'required|min:6',
            'jurusan' => 'required',
            'angkatan' => 'required|numeric'
        ]);

        Mahasiswa::create($request->all());
        return redirect()->route('mahasiswa.index')->with('success', 'Data mahasiswa berhasil ditambahkan');
    }

    public function show(Mahasiswa $mahasiswa)
    {
        return view('mahasiswa.show', compact('mahasiswa'));
    }

    public function edit(Mahasiswa $mahasiswa)
    {
        return view('mahasiswa.edit', compact('mahasiswa'));
    }

    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        $request->validate([
            'nim' => 'required|unique:mahasiswa,nim,' . $mahasiswa->id,
            'nama' => 'required',
            'email' => 'required|email|unique:mahasiswa,email,' . $mahasiswa->id,
            'jurusan' => 'required',
            'angkatan' => 'required|numeric'
        ]);

        $mahasiswa->update($request->all());
        return redirect()->route('mahasiswa.index')->with('success', 'Data mahasiswa berhasil diperbarui');
    }

    public function destroy(Mahasiswa $mahasiswa)
    {
        $mahasiswa->delete();
        return redirect()->route('mahasiswa.index')->with('success', 'Data mahasiswa berhasil dihapus');
    }

    public function dashboard()
    {
        $mahasiswa = Mahasiswa::where('email', Auth::user()->email)->first();
        
        if (!$mahasiswa) {
            return redirect()->route('login')->with('error', 'Data mahasiswa tidak ditemukan');
        }

        $jadwalBimbingan = JadwalBimbingan::with('dosen')
            ->where('nim', $mahasiswa->nim)
            ->orderBy('tanggal', 'desc')
            ->get();

        $totalJadwal = $jadwalBimbingan->count();
        $jadwalHariIni = $jadwalBimbingan->where('tanggal', date('Y-m-d'))->count();
        $jadwalMingguIni = $jadwalBimbingan->whereBetween('tanggal', [
            now()->startOfWeek(),
            now()->endOfWeek()
        ])->count();

        $dosen = Dosen::all();

        return view('mahasiswa.dashboard', compact('mahasiswa', 'jadwalBimbingan', 'totalJadwal', 'jadwalHariIni', 'jadwalMingguIni', 'dosen'));
    }

    public function jadwal()
    {
        $mahasiswa = Mahasiswa::where('email', Auth::user()->email)->first();
        
        if (!$mahasiswa) {
            return redirect()->route('login')->with('error', 'Data mahasiswa tidak ditemukan');
        }

        $jadwalBimbingan = JadwalBimbingan::with('dosen')
            ->where('nim', $mahasiswa->nim)
            ->orderBy('tanggal', 'desc')
            ->get();

        return view('mahasiswa.jadwal', compact('mahasiswa', 'jadwalBimbingan'));
    }

    public function buatJadwal(Request $request)
    {
        $request->validate([
            'id_dosen' => 'required|exists:dosen,id_dosen',
            'tanggal' => 'required|date|after_or_equal:today',
            'waktu_mulai' => 'required',
            'waktu_selesai' => 'required|after:waktu_mulai',
            'topik' => 'required|string|max:255'
        ]);

        $mahasiswa = Mahasiswa::where('email', Auth::user()->email)->first();
        
        if (!$mahasiswa) {
            return redirect()->back()->with('error', 'Data mahasiswa tidak ditemukan');
        }

        JadwalBimbingan::create([
            'id_dosen' => $request->id_dosen,
            'nim' => $mahasiswa->nim,
            'tanggal' => $request->tanggal,
            'waktu_mulai' => $request->waktu_mulai,
            'waktu_selesai' => $request->waktu_selesai,
            'topik' => $request->topik,
            'status' => 'menunggu_persetujuan'
        ]);

        return redirect()->back()->with('success', 'Jadwal bimbingan berhasil dibuat');
    }
} 