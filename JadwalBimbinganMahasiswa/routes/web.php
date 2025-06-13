<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;

// Route untuk guest (belum login)
Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    
    // Route untuk manajemen dosen
    Route::resource('dosen', AdminController::class)->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);
    
    // Route untuk manajemen mahasiswa
    Route::resource('mahasiswa', AdminController::class)->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);
    
    // Route untuk manajemen jadwal
    Route::resource('jadwal', AdminController::class)->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);
});

// User routes (Dosen & Mahasiswa)
Route::resource('mahasiswa', MahasiswaController::class);
Route::resource('dosen', DosenController::class);
Route::resource('jadwal', JadwalController::class);
Route::get('/dashboard', [UserController::class, 'index'])->name('user.dashboard');