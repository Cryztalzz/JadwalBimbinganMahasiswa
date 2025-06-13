<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\JadwalBimbingan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalDosen = Dosen::count();
        $totalMahasiswa = Mahasiswa::count();
        $totalJadwal = JadwalBimbingan::count();
        
        return view('admin.dashboard', compact('totalDosen', 'totalMahasiswa', 'totalJadwal'));
    }

    // Manajemen Dosen
    public function dosenIndex()
    {
        $dosen = Dosen::with('user')->get();
        return view('admin.dosen.index', compact('dosen'));
    }

    public function dosenCreate()
    {
        return view('admin.dosen.create');
    }

    public function dosenStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'nip' => 'required|string|unique:dosen',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'dosen'
        ]);

        Dosen::create([
            'user_id' => $user->id,
            'nip' => $request->nip,
        ]);

        return redirect()->route('admin.dosen.index')->with('success', 'Dosen berhasil ditambahkan');
    }

    // Edit dan Delete Dosen
    public function dosenEdit($id)
    {
        $dosen = Dosen::with('user')->findOrFail($id);
        return view('admin.dosen.edit', compact('dosen'));
    }

    public function dosenUpdate(Request $request, $id)
    {
        $dosen = Dosen::findOrFail($id);
        $user = $dosen->user;

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'nip' => 'required|string|unique:dosen,nip,' . $id,
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        $dosen->update([
            'nip' => $request->nip,
        ]);

        return redirect()->route('admin.dosen.index')->with('success', 'Data dosen berhasil diperbarui');
    }

    public function dosenDestroy($id)
    {
        $dosen = Dosen::findOrFail($id);
        $user = $dosen->user;
        
        $dosen->delete();
        $user->delete();

        return redirect()->route('admin.dosen.index')->with('success', 'Dosen berhasil dihapus');
    }

    // Manajemen Mahasiswa
    public function mahasiswaIndex()
    {
        $mahasiswa = Mahasiswa::with('user')->get();
        return view('admin.mahasiswa.index', compact('mahasiswa'));
    }

    public function mahasiswaCreate()
    {
        return view('admin.mahasiswa.create');
    }

    public function mahasiswaStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'nim' => 'required|string|unique:mahasiswa',
        ]);

        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'mahasiswa'
        ]);

        Mahasiswa::create([
            'user_id' => $user->id,
            'nim' => $request->nim,
        ]);

        return redirect()->route('admin.mahasiswa.index')->with('success', 'Mahasiswa berhasil ditambahkan');
    }

    // Edit dan Delete Mahasiswa
    public function mahasiswaEdit($id)
    {
        $mahasiswa = Mahasiswa::with('user')->findOrFail($id);
        return view('admin.mahasiswa.edit', compact('mahasiswa'));
    }

    public function mahasiswaUpdate(Request $request, $id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        $user = $mahasiswa->user;

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'nim' => 'required|string|unique:mahasiswa,nim,' . $id,
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        $mahasiswa->update([
            'nim' => $request->nim,
        ]);

        return redirect()->route('admin.mahasiswa.index')->with('success', 'Data mahasiswa berhasil diperbarui');
    }

    public function mahasiswaDestroy($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        $user = $mahasiswa->user;
        
        $mahasiswa->delete();
        $user->delete();

        return redirect()->route('admin.mahasiswa.index')->with('success', 'Mahasiswa berhasil dihapus');
    }

    // Manajemen Jadwal
    public function jadwalIndex()
    {
        $jadwal = JadwalBimbingan::with(['mahasiswa.user', 'dosen.user'])->get();
        return view('admin.jadwal.index', compact('jadwal'));
    }

    public function jadwalCreate()
    {
        $dosen = Dosen::with('user')->get();
        $mahasiswa = Mahasiswa::with('user')->get();
        return view('admin.jadwal.create', compact('dosen', 'mahasiswa'));
    }

    public function jadwalStore(Request $request)
    {
        $request->validate([
            'dosen_id' => 'required|exists:dosen,id',
            'mahasiswa_id' => 'required|exists:mahasiswa,id',
            'tanggal' => 'required|date',
            'waktu_mulai' => 'required',
            'waktu_selesai' => 'required',
            'topik' => 'required|string',
        ]);

        JadwalBimbingan::create($request->all());

        return redirect()->route('admin.jadwal.index')->with('success', 'Jadwal berhasil ditambahkan');
    }

    // Edit dan Delete Jadwal
    public function jadwalEdit($id)
    {
        $jadwal = JadwalBimbingan::findOrFail($id);
        $dosen = Dosen::with('user')->get();
        $mahasiswa = Mahasiswa::with('user')->get();
        return view('admin.jadwal.edit', compact('jadwal', 'dosen', 'mahasiswa'));
    }

    public function jadwalUpdate(Request $request, $id)
    {
        $jadwal = JadwalBimbingan::findOrFail($id);

        $request->validate([
            'dosen_id' => 'required|exists:dosen,id',
            'mahasiswa_id' => 'required|exists:mahasiswa,id',
            'tanggal' => 'required|date',
            'waktu_mulai' => 'required',
            'waktu_selesai' => 'required',
            'topik' => 'required|string',
        ]);

        $jadwal->update($request->all());

        return redirect()->route('admin.jadwal.index')->with('success', 'Jadwal berhasil diperbarui');
    }

    public function jadwalDestroy($id)
    {
        $jadwal = JadwalBimbingan::findOrFail($id);
        $jadwal->delete();

        return redirect()->route('admin.jadwal.index')->with('success', 'Jadwal berhasil dihapus');
    }
}