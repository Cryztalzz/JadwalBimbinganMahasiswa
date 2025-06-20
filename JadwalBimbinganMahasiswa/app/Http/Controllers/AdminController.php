<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\JadwalBimbingan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalDosen = Dosen::count();
        $totalMahasiswa = Mahasiswa::count();
        $totalJadwal = JadwalBimbingan::count();

        // Statistik bimbingan hari ini
        $bimbinganHariIni = JadwalBimbingan::whereDate('tanggal', Carbon::today())->count();
        
        // Statistik bimbingan minggu ini
        $bimbinganMingguIni = JadwalBimbingan::whereBetween('tanggal', [
            Carbon::now()->startOfWeek(),
            Carbon::now()->endOfWeek()
        ])->count();
        
        // Statistik status bimbingan
        $menungguKonfirmasi = JadwalBimbingan::where('status', 'menunggu_persetujuan')->count();
        $bimbinganAktif = JadwalBimbingan::where('status', 'disetujui')->count();

        return view('admin.dashboard', compact(
            'totalDosen',
            'totalMahasiswa',
            'totalJadwal',
            'bimbinganHariIni',
            'bimbinganMingguIni',
            'menungguKonfirmasi',
            'bimbinganAktif'
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
        try {
            $request->validate([
                'name' => 'required|string|max:255|regex:/^[a-zA-Z\s]+$/',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8',
                'nip' => 'required|numeric|unique:dosen',
                'notelp' => 'required|numeric|digits_between:10,15|regex:/^08[0-9]{8,13}$/'
            ]);

            DB::beginTransaction();
            try {
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
                    'nama_dosen' => $request->name,
                    'nip' => $request->nip,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'notelp' => $request->notelp
                ]);

                DB::commit();
                return redirect()->route('admin.dosen.index')
                    ->with('success', 'Dosen berhasil ditambahkan');
            } catch (\Exception $e) {
                DB::rollback();
                Log::error('Error creating dosen: ' . $e->getMessage(), [
                    'trace' => $e->getTraceAsString(),
                    'request' => $request->all()
                ]);
                
                // Cek apakah error karena duplikasi
                if (str_contains($e->getMessage(), 'Duplicate entry')) {
                    if (str_contains($e->getMessage(), 'users_username_unique')) {
                        return redirect()->back()
                            ->withInput()
                            ->with('error', 'Username sudah digunakan. Silakan gunakan email yang berbeda.');
                    } elseif (str_contains($e->getMessage(), 'users_email_unique')) {
                        return redirect()->back()
                            ->withInput()
                            ->with('error', 'Email sudah digunakan. Silakan gunakan email yang berbeda.');
                    } elseif (str_contains($e->getMessage(), 'dosen_nip_unique')) {
                        return redirect()->back()
                            ->withInput()
                            ->with('error', 'NIP sudah digunakan. Silakan gunakan NIP yang berbeda.');
                    }
                }
                
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage());
            }
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->validator)
                ->withInput();
        } catch (\Exception $e) {
            Log::error('Error in dosenStore: ' . $e->getMessage());
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
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
            'notelp' => $request->notelp,
            'email' => $request->email
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
        try {
            $request->validate([
                'name' => 'required|string|max:255|regex:/^[a-zA-Z\s]+$/',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8',
                'nim' => 'required|numeric|unique:mahasiswa|digits_between:8,15',
                'jurusan' => 'required|string|max:100|regex:/^[a-zA-Z\s]+$/',
                'angkatan' => 'required|integer|min:2000|max:' . (date('Y') + 1),
                'notelp' => 'required|numeric|digits_between:10,15|regex:/^08[0-9]{8,13}$/'
            ]);

            DB::beginTransaction();
            try {
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
                    'jurusan' => $request->jurusan,
                    'angkatan' => $request->angkatan,
                    'notelp' => $request->notelp
                ]);

                DB::commit();
                return redirect()->route('admin.mahasiswa.index')
                    ->with('success', 'Mahasiswa berhasil ditambahkan');
            } catch (\Exception $e) {
                DB::rollback();
                Log::error('Error creating mahasiswa: ' . $e->getMessage());
                
                // Cek apakah error karena duplikasi
                if (str_contains($e->getMessage(), 'Duplicate entry')) {
                    if (str_contains($e->getMessage(), 'users_username_unique')) {
                        return redirect()->back()
                            ->withInput()
                            ->with('error', 'Username sudah digunakan. Silakan gunakan email yang berbeda.');
                    } elseif (str_contains($e->getMessage(), 'users_email_unique')) {
                        return redirect()->back()
                            ->withInput()
                            ->with('error', 'Email sudah digunakan. Silakan gunakan email yang berbeda.');
                    } elseif (str_contains($e->getMessage(), 'mahasiswa_nim_unique')) {
                        return redirect()->back()
                            ->withInput()
                            ->with('error', 'NIM sudah digunakan. Silakan gunakan NIM yang berbeda.');
                    }
                }
                
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage());
            }
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->validator)
                ->withInput();
        } catch (\Exception $e) {
            Log::error('Error in mahasiswaStore: ' . $e->getMessage());
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
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
            'waktu_selesai' => 'required|after:waktu_mulai',
            'topik' => 'required|string|max:255'
        ]);

        JadwalBimbingan::create([
            'id_dosen' => $request->id_dosen,
            'nim' => $request->nim,
            'tanggal' => $request->tanggal,
            'waktu_mulai' => $request->waktu_mulai,
            'waktu_selesai' => $request->waktu_selesai,
            'topik' => $request->topik,
            'status' => 'menunggu_persetujuan'
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
            'topik' => 'required|string|max:255',
            'status' => 'required|in:menunggu_persetujuan,disetujui,ditolak,dibatalkan,selesai'
        ]);

        try {
            $jadwal->update([
                'id_dosen' => $request->id_dosen,
                'nim' => $request->nim,
                'tanggal' => $request->tanggal,
                'waktu_mulai' => $request->waktu_mulai,
                'waktu_selesai' => $request->waktu_selesai,
                'topik' => $request->topik,
                'status' => $request->status
            ]);

            return redirect()->route('admin.jadwal.index')
                ->with('success', 'Jadwal bimbingan berhasil diperbarui');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat memperbarui jadwal: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function jadwalDestroy($id)
    {
        $jadwal = JadwalBimbingan::findOrFail($id);
        $jadwal->delete();

        return redirect()->route('admin.jadwal.index')
            ->with('success', 'Jadwal bimbingan berhasil dihapus');
    }
}