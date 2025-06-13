@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-chalkboard-teacher me-2"></i>
                    Panel Dosen
                </div>

                <div class="card-body p-5">
                    <div class="text-center mb-5">
                        <i class="fas fa-chalkboard-teacher feature-icon mb-4"></i>
                        <h2 class="welcome-title mb-3">Selamat Datang di Panel Dosen</h2>
                        <p class="welcome-text">Kelola jadwal bimbingan dengan mahasiswa bimbingan Anda</p>
                    </div>

                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h3 class="feature-title mb-3">
                                        <i class="fas fa-calendar-check me-2"></i>
                                        Jadwal Bimbingan
                                    </h3>
                                    <p class="feature-text">Lihat dan atur jadwal bimbingan dengan mahasiswa bimbingan</p>
                                    <a href="{{ route('jadwal.index') }}" class="btn btn-primary btn-custom">
                                        <i class="fas fa-arrow-right me-2"></i>Lihat Jadwal
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h3 class="feature-title mb-3">
                                        <i class="fas fa-users me-2"></i>
                                        Mahasiswa Bimbingan
                                    </h3>
                                    <p class="feature-text">Lihat daftar dan informasi mahasiswa bimbingan Anda</p>
                                    <a href="{{ route('mahasiswa.index') }}" class="btn btn-success btn-custom">
                                        <i class="fas fa-arrow-right me-2"></i>Lihat Mahasiswa
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 