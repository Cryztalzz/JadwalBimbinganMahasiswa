<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;

// Route untuk autentikasi
Route::get('/', function () {
    return view('welcome');
});

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