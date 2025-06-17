<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HelpController;
use App\Http\Controllers\JadwalBimbinganController;
use App\Http\Controllers\PenilaianBimbinganController;
use App\Http\Controllers\PenilaianMahasiswaController;

// Route untuk autentikasi
Route::get('/', function () {
    if (auth()->check()) {
        $user = auth()->user();
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif ($user->role === 'dosen') {
            return redirect()->route('dosen.dashboard');
        } elseif ($user->role === 'mahasiswa') {
            return redirect()->route('mahasiswa.dashboard');
        }
    }
    return view('welcome');
})->middleware('guest');

Route::get('/home', function () {
    if (auth()->check()) {
        $user = auth()->user();
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif ($user->role === 'dosen') {
            return redirect()->route('dosen.dashboard');
        } elseif ($user->role === 'mahasiswa') {
            return redirect()->route('mahasiswa.dashboard');
        }
    }
    return redirect('/');
})->middleware('auth');

Route::get('/login', [App\Http\Controllers\AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [App\Http\Controllers\AuthController::class, 'login']);
Route::post('/logout', [App\Http\Controllers\AuthController::class, 'logout'])->name('logout');

// Route untuk Dosen
Route::middleware(['auth', 'role:dosen'])->prefix('dosen')->name('dosen.')->group(function () {
    Route::get('/dashboard', [DosenController::class, 'dashboard'])->name('dashboard');
    Route::get('/jadwal', [DosenController::class, 'jadwal'])->name('jadwal');
    Route::get('/jadwal/{id}/edit', [DosenController::class, 'jadwalEdit'])->name('jadwal.edit');
    Route::put('/jadwal/{id}', [DosenController::class, 'jadwalUpdate'])->name('jadwal.update');
    Route::delete('/jadwal/{id}', [DosenController::class, 'jadwalDestroy'])->name('jadwal.destroy');
    Route::post('/jadwal/{id}/approve', [DosenController::class, 'approveJadwal'])->name('jadwal.approve');
    Route::post('/jadwal/{id}/reject', [DosenController::class, 'rejectJadwal'])->name('jadwal.reject');
    Route::post('/jadwal/{id}/complete', [DosenController::class, 'completeJadwal'])->name('jadwal.complete');
});

// Route untuk Mahasiswa
Route::middleware(['auth', 'role:mahasiswa'])->prefix('mahasiswa')->name('mahasiswa.')->group(function () {
    Route::get('/dashboard', [MahasiswaController::class, 'dashboard'])->name('dashboard');
    Route::get('/jadwal', [MahasiswaController::class, 'jadwal'])->name('jadwal');
    Route::post('/jadwal', [MahasiswaController::class, 'buatJadwal'])->name('jadwal.store');
});

// Route untuk Admin
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    
    // Route untuk manajemen dosen
    Route::get('/dosen', [AdminController::class, 'dosenIndex'])->name('dosen.index');
    Route::get('/dosen/create', [AdminController::class, 'dosenCreate'])->name('dosen.create');
    Route::post('/dosen', [AdminController::class, 'dosenStore'])->name('dosen.store');
    Route::get('/dosen/{id}/edit', [AdminController::class, 'dosenEdit'])->name('dosen.edit');
    Route::put('/dosen/{id}', [AdminController::class, 'dosenUpdate'])->name('dosen.update');
    Route::delete('/dosen/{id}', [AdminController::class, 'dosenDestroy'])->name('dosen.destroy');
    
    // Route untuk manajemen mahasiswa
    Route::get('/mahasiswa', [AdminController::class, 'mahasiswaIndex'])->name('mahasiswa.index');
    Route::get('/mahasiswa/create', [AdminController::class, 'mahasiswaCreate'])->name('mahasiswa.create');
    Route::post('/mahasiswa', [AdminController::class, 'mahasiswaStore'])->name('mahasiswa.store');
    Route::get('/mahasiswa/{id}/edit', [AdminController::class, 'mahasiswaEdit'])->name('mahasiswa.edit');
    Route::put('/mahasiswa/{id}', [AdminController::class, 'mahasiswaUpdate'])->name('mahasiswa.update');
    Route::delete('/mahasiswa/{id}', [AdminController::class, 'mahasiswaDestroy'])->name('mahasiswa.destroy');
    
    // Route untuk manajemen jadwal
    Route::get('/jadwal', [AdminController::class, 'jadwalIndex'])->name('jadwal.index');
    Route::get('/jadwal/create', [AdminController::class, 'jadwalCreate'])->name('jadwal.create');
    Route::post('/jadwal', [AdminController::class, 'jadwalStore'])->name('jadwal.store');
    Route::get('/jadwal/{id}/edit', [AdminController::class, 'jadwalEdit'])->name('jadwal.edit');
    Route::put('/jadwal/{id}', [AdminController::class, 'jadwalUpdate'])->name('jadwal.update');
    Route::delete('/jadwal/{id}', [AdminController::class, 'jadwalDestroy'])->name('jadwal.destroy');
});

// User routes (Dosen & Mahasiswa)
Route::resource('mahasiswa', MahasiswaController::class);
Route::resource('dosen', DosenController::class);
Route::resource('jadwal', JadwalController::class);
Route::get('/dashboard', [UserController::class, 'index'])->name('user.dashboard');

// Admin routes
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
});

Route::middleware(['auth'])->group(function () {
    // Profile Routes
    Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'show'])->name('profile.show');
    Route::put('/profile/password', [App\Http\Controllers\ProfileController::class, 'updatePassword'])->name('profile.password.update');
    Route::put('/profile/photo', [App\Http\Controllers\ProfileController::class, 'updatePhoto'])->name('profile.photo.update');
});

// Help Routes
Route::get('/help/faq', [HelpController::class, 'faq'])->name('help.faq');
Route::get('/help/contact', [HelpController::class, 'contact'])->name('help.contact');

// Jadwal Bimbingan Routes
Route::middleware(['auth', 'role:mahasiswa'])->group(function () {
    Route::get('/jadwal-bimbingan', [JadwalBimbinganController::class, 'index'])->name('jadwal-bimbingan.index');
    Route::get('/jadwal-bimbingan/create', [JadwalBimbinganController::class, 'create'])->name('jadwal-bimbingan.create');
    Route::post('/jadwal-bimbingan', [JadwalBimbinganController::class, 'store'])->name('jadwal-bimbingan.store');
    Route::post('/jadwal-bimbingan/{id}/cancel', [JadwalBimbinganController::class, 'cancel'])->name('jadwal-bimbingan.cancel');
    Route::get('/jadwal-bimbingan/{id}', [JadwalBimbinganController::class, 'show'])->name('jadwal-bimbingan.show');
    
    // Route untuk penilaian mahasiswa
    Route::get('/mahasiswa/penilaian/{id_jadwal}/create', [PenilaianMahasiswaController::class, 'create'])->name('mahasiswa.penilaian.create');
    Route::post('/mahasiswa/penilaian/{id_jadwal}', [PenilaianMahasiswaController::class, 'store'])->name('mahasiswa.penilaian.store');
    Route::get('/mahasiswa/penilaian/{id_jadwal}', [PenilaianMahasiswaController::class, 'show'])->name('mahasiswa.penilaian.show');
});

Route::middleware(['auth', 'role:dosen'])->group(function () {
    Route::post('/jadwal-bimbingan/{id}/mark-as-selesai', [JadwalBimbinganController::class, 'markAsSelesai'])->name('jadwal-bimbingan.mark-as-selesai');
    Route::get('/penilaian/{id_jadwal}/create', [PenilaianBimbinganController::class, 'create'])->name('penilaian.create');
    Route::post('/penilaian/{id_jadwal}', [PenilaianBimbinganController::class, 'store'])->name('penilaian.store');
});

// Penilaian Bimbingan Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/penilaian/riwayat', [PenilaianBimbinganController::class, 'riwayat'])->name('penilaian.riwayat');
    Route::get('/penilaian/{id_jadwal}', [PenilaianBimbinganController::class, 'show'])->name('penilaian.show');
    Route::get('/penilaian/create/{id_jadwal}', [PenilaianBimbinganController::class, 'create'])->name('penilaian.create');
    Route::post('/penilaian/store/{id_jadwal}', [PenilaianBimbinganController::class, 'store'])->name('penilaian.store');
    Route::get('/penilaian/show/{id_jadwal}', [PenilaianBimbinganController::class, 'show'])->name('penilaian.show');
});

Route::get('/calendar', function () {
    return view('calendar');
})->name('calendar');