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
        $jadwal = JadwalBimbingan::with(['mahasiswa', 'dosen'])->findOrFail($id_jadwal);
        
        // Pastikan hanya dosen yang terkait yang bisa memberikan penilaian
        if (Auth::user()->email !== $jadwal->dosen->email) {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses untuk memberikan penilaian');
        }

        return view('penilaian.create', compact('jadwal'));
    }

    public function store(Request $request, $id_jadwal)
    {
        $request->validate([
            'catatan_bimbingan' => 'required|string',
            'nilai_kehadiran' => 'required|integer|min:1|max:5',
            'nilai_kesiapan' => 'required|integer|min:1|max:5',
            'nilai_kemajuan' => 'required|integer|min:1|max:5',
            'feedback' => 'nullable|string',
            'rencana_tindak_lanjut' => 'nullable|string'
        ]);

        $jadwal = JadwalBimbingan::findOrFail($id_jadwal);
        
        // Pastikan hanya dosen yang terkait yang bisa memberikan penilaian
        if (Auth::user()->email !== $jadwal->dosen->email) {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses untuk memberikan penilaian');
        }

        PenilaianBimbingan::create([
            'id_jadwal' => $id_jadwal,
            'catatan_bimbingan' => $request->catatan_bimbingan,
            'nilai_kehadiran' => $request->nilai_kehadiran,
            'nilai_kesiapan' => $request->nilai_kesiapan,
            'nilai_kemajuan' => $request->nilai_kemajuan,
            'feedback' => $request->feedback,
            'rencana_tindak_lanjut' => $request->rencana_tindak_lanjut
        ]);

        // Update status jadwal menjadi selesai
        $jadwal->update(['status' => 'selesai']);

        return redirect()->route('dosen.jadwal')
            ->with('success', 'Penilaian bimbingan berhasil disimpan');
    }

    public function show($id_jadwal)
    {
        $jadwal = JadwalBimbingan::with(['mahasiswa', 'dosen', 'penilaianBimbingan'])
            ->findOrFail($id_jadwal);
        
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