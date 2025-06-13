<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\JadwalBimbingan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalDosen = Dosen::count();
        $totalMahasiswa = Mahasiswa::count();
        $totalJadwal = JadwalBimbingan::count();

        return view('admin.dashboard', compact(
            'totalDosen',
            'totalMahasiswa',
            'totalJadwal'
        ));
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
            'notelp' => 'required|string|max:20'
        ]);

        // Generate username dari email
        $username = explode('@', $request->email)[0];

        // Buat user baru
        $user = User::create([
            'name' => $request->name,
            'username' => $username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'dosen'
        ]);

        // Buat data dosen
        Dosen::create([
            'id_dosen' => $user->id,
            'nama_dosen' => $request->name,
            'nip' => $request->nip,
            'password' => Hash::make($request->password),
            'notelp' => $request->notelp
        ]);

        return redirect()->route('admin.dosen.index')
            ->with('success', 'Dosen berhasil ditambahkan');
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
            'nip' => 'required|string|unique:dosen,nip,' . $id . ',id_dosen',
            'notelp' => 'required|string|max:20',
            'password' => 'nullable|string|min:8'
        ]);

        // Update data user
        $userData = [
            'name' => $request->name,
            'email' => $request->email
        ];

        // Update password jika diisi
        if ($request->filled('password')) {
            $userData['password'] = Hash::make($request->password);
        }

        $user->update($userData);

        // Update data dosen
        $dosen->update([
            'nama_dosen' => $request->name,
            'nip' => $request->nip,
            'notelp' => $request->notelp
        ]);

        // Update password dosen jika diisi
        if ($request->filled('password')) {
            $dosen->update([
                'password' => Hash::make($request->password)
            ]);
        }

        return redirect()->route('admin.dosen.index')
            ->with('success', 'Data dosen berhasil diperbarui');
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
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'nim' => 'required|string|unique:mahasiswa',
            'jurusan' => 'required|string|max:100',
            'angkatan' => 'required|integer|min:2000|max:' . (date('Y') + 1),
            'notelp' => 'required|string|max:20'
        ]);

        // Generate username dari email
        $username = explode('@', $request->email)[0];

        // Buat user baru
        $user = User::create([
            'name' => $request->name,
            'username' => $username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'mahasiswa'
        ]);

        // Buat data mahasiswa
        Mahasiswa::create([
            'nim' => $request->nim,
            'nama' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'notelp' => $request->notelp
        ]);

        return redirect()->route('admin.mahasiswa.index')
            ->with('success', 'Mahasiswa berhasil ditambahkan');
    }

    // Edit dan Delete Mahasiswa
    public function mahasiswaEdit($id)
    {
        $mahasiswa = Mahasiswa::with('user')->findOrFail($id);
        return view('admin.mahasiswa.edit', compact('mahasiswa'));
    }

    public function mahasiswaUpdate(Request $request, $nim)
    {
        $mahasiswa = Mahasiswa::findOrFail($nim);
        $user = $mahasiswa->user;

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'nim' => 'required|string|unique:mahasiswa,nim,' . $nim . ',nim',
            'notelp' => 'required|string|max:20',
            'password' => 'nullable|string|min:8'
        ]);

        // Update data user
        $userData = [
            'name' => $request->name,
            'email' => $request->email
        ];

        // Update password jika diisi
        if ($request->filled('password')) {
            $userData['password'] = Hash::make($request->password);
        }

        $user->update($userData);

        // Update data mahasiswa
        $mahasiswaData = [
            'nama' => $request->name,
            'email' => $request->email,
            'nim' => $request->nim,
            'notelp' => $request->notelp
        ];

        // Update password mahasiswa jika diisi
        if ($request->filled('password')) {
            $mahasiswaData['password'] = Hash::make($request->password);
        }

        $mahasiswa->update($mahasiswaData);

        return redirect()->route('admin.mahasiswa.index')
            ->with('success', 'Data mahasiswa berhasil diperbarui');
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
        $dosen = Dosen::all();
        $mahasiswa = Mahasiswa::all();
        return view('admin.jadwal.create', compact('dosen', 'mahasiswa'));
    }

    public function jadwalStore(Request $request)
    {
        $request->validate([
            'id_dosen' => 'required|exists:dosen,id_dosen',
            'nim' => 'required|exists:mahasiswa,nim',
            'tanggal' => 'required|date',
            'waktu_mulai' => 'required',
            'waktu_selesai' => 'required|after:waktu_mulai'
        ]);

        JadwalBimbingan::create([
            'id_dosen' => $request->id_dosen,
            'nim' => $request->nim,
            'tanggal' => $request->tanggal,
            'waktu_mulai' => $request->waktu_mulai,
            'waktu_selesai' => $request->waktu_selesai,
            'status' => 'dipesan'
        ]);

        return redirect()->route('admin.jadwal.index')
            ->with('success', 'Jadwal bimbingan berhasil ditambahkan');
    }

    // Edit dan Delete Jadwal
    public function jadwalEdit($id)
    {
        $jadwal = JadwalBimbingan::findOrFail($id);
        $dosen = Dosen::all();
        $mahasiswa = Mahasiswa::all();
        return view('admin.jadwal.edit', compact('jadwal', 'dosen', 'mahasiswa'));
    }

    public function jadwalUpdate(Request $request, $id)
    {
        $jadwal = JadwalBimbingan::findOrFail($id);

        $request->validate([
            'id_dosen' => 'required|exists:dosen,id_dosen',
            'nim' => 'required|exists:mahasiswa,nim',
            'tanggal' => 'required|date',
            'waktu_mulai' => 'required',
            'waktu_selesai' => 'required|after:waktu_mulai',
            'status' => 'required|in:tersedia,dipesan,selesai'
        ]);

        $jadwal->update([
            'id_dosen' => $request->id_dosen,
            'nim' => $request->nim,
            'tanggal' => $request->tanggal,
            'waktu_mulai' => $request->waktu_mulai,
            'waktu_selesai' => $request->waktu_selesai,
            'status' => $request->status
        ]);

        return redirect()->route('admin.jadwal.index')
            ->with('success', 'Jadwal bimbingan berhasil diperbarui');
    }

    public function jadwalDestroy($id)
    {
        $jadwal = JadwalBimbingan::findOrFail($id);
        $jadwal->delete();

        return redirect()->route('admin.jadwal.index')
            ->with('success', 'Jadwal bimbingan berhasil dihapus');
    }
}