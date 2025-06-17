<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\JadwalBimbingan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller as BaseController;

class DosenController extends BaseController
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:dosen');
    }

    public function index()
    {
        $dosen = Dosen::all();
        return view('dosen.index', compact('dosen'));
    }

    public function create()
    {
        return view('dosen.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nip' => 'required|unique:dosen',
            'nama' => 'required',
            'email' => 'required|email|unique:dosen',
            'password' => 'required|min:6',
            'bidang_keahlian' => 'required'
        ]);

        Dosen::create($request->all());
        return redirect()->route('dosen.index')->with('success', 'Data dosen berhasil ditambahkan');
    }

    public function show(Dosen $dosen)
    {
        return view('dosen.show', compact('dosen'));
    }

    public function edit(Dosen $dosen)
    {
        return view('dosen.edit', compact('dosen'));
    }

    public function update(Request $request, Dosen $dosen)
    {
        $request->validate([
            'nip' => 'required|unique:dosen,nip,' . $dosen->id,
            'nama' => 'required',
            'email' => 'required|email|unique:dosen,email,' . $dosen->id,
            'bidang_keahlian' => 'required'
        ]);

        $dosen->update($request->all());
        return redirect()->route('dosen.index')->with('success', 'Data dosen berhasil diperbarui');
    }

    public function destroy(Dosen $dosen)
    {
        $dosen->delete();
        return redirect()->route('dosen.index')->with('success', 'Data dosen berhasil dihapus');
    }

    public function dashboard()
    {
        $dosen = Dosen::where('email', Auth::user()->email)->first();
        
        if (!$dosen) {
            return redirect()->route('login')->with('error', 'Data dosen tidak ditemukan');
        }

        $jadwal = JadwalBimbingan::with(['mahasiswa', 'dosen'])
            ->where('id_dosen', $dosen->id_dosen)
            ->orderBy('tanggal', 'desc')
            ->get();
        
        $totalJadwal = $jadwal->count();
        $jadwalHariIni = $jadwal->where('tanggal', date('Y-m-d'))->count();
        $jadwalMingguIni = $jadwal->whereBetween('tanggal', [
            now()->startOfWeek(),
            now()->endOfWeek()
        ])->count();
        
        return view('dosen.dashboard', compact('dosen', 'jadwal', 'totalJadwal', 'jadwalHariIni', 'jadwalMingguIni'));
    }

    public function jadwal()
    {
        $dosen = Dosen::where('email', Auth::user()->email)->first();
        
        if (!$dosen) {
            return redirect()->route('login')->with('error', 'Data dosen tidak ditemukan');
        }

        $jadwal = JadwalBimbingan::with(['mahasiswa', 'dosen'])
            ->where('id_dosen', $dosen->id_dosen)
            ->orderBy('tanggal', 'desc')
            ->get();
        
        return view('dosen.jadwal', compact('dosen', 'jadwal'));
    }

    public function jadwalEdit($id)
    {
        $jadwal = JadwalBimbingan::findOrFail($id);
        return view('dosen.jadwal.edit', compact('jadwal'));
    }

    public function jadwalUpdate(Request $request, $id)
    {
        $jadwal = JadwalBimbingan::findOrFail($id);

        $request->validate([
            'status' => 'required|in:menunggu_persetujuan,disetujui,ditolak'
        ]);

        $jadwal->update([
            'status' => $request->status
        ]);

        return redirect()->route('dosen.jadwal')
            ->with('success', 'Status jadwal berhasil diperbarui');
    }

    public function jadwalDestroy($id)
    {
        $jadwal = JadwalBimbingan::findOrFail($id);
        $jadwal->delete();

        return redirect()->route('dosen.jadwal')
            ->with('success', 'Jadwal berhasil dihapus');
    }

    public function approveJadwal($id)
    {
        $jadwal = JadwalBimbingan::findOrFail($id);
        
        // Pastikan hanya dosen yang terkait yang bisa menyetujui
        if ($jadwal->id_dosen != auth()->user()->dosen->id_dosen) {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses untuk menyetujui jadwal ini');
        }

        $jadwal->update(['status' => 'disetujui']);
        return redirect()->back()->with('success', 'Jadwal bimbingan berhasil disetujui');
    }

    public function rejectJadwal($id)
    {
        $jadwal = JadwalBimbingan::findOrFail($id);
        
        // Pastikan hanya dosen yang terkait yang bisa menolak
        if ($jadwal->id_dosen != auth()->user()->dosen->id_dosen) {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses untuk menolak jadwal ini');
        }

        $jadwal->update(['status' => 'ditolak']);
        return redirect()->back()->with('success', 'Jadwal bimbingan berhasil ditolak');
    }

    public function completeJadwal($id)
    {
        $jadwal = JadwalBimbingan::findOrFail($id);
        
        // Pastikan hanya dosen yang terkait yang bisa menandai selesai
        if ($jadwal->id_dosen != auth()->user()->dosen->id_dosen) {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses untuk menandai jadwal ini');
        }

        // Pastikan jadwal sudah disetujui
        if ($jadwal->status !== 'disetujui') {
            return redirect()->back()->with('error', 'Jadwal harus disetujui terlebih dahulu');
        }

        try {
            $jadwal->update(['status' => 'selesai']);
            return redirect()->back()->with('success', 'Jadwal bimbingan berhasil ditandai selesai');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menandai jadwal sebagai selesai');
        }
    }
} 