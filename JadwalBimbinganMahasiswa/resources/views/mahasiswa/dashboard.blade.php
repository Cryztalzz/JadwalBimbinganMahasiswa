@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-user-graduate me-2"></i>
                    Panel Mahasiswa
                </div>

                <div class="card-body p-5">
                    <div class="text-center mb-5">
                        <i class="fas fa-user-graduate feature-icon mb-4"></i>
                        <h2 class="welcome-title mb-3">Selamat Datang di Panel Mahasiswa</h2>
                        <p class="welcome-text">Kelola jadwal bimbingan Anda dengan dosen pembimbing secara efisien</p>
                    </div>

                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h3 class="feature-title mb-3">
                                        <i class="fas fa-calendar-check me-2"></i>
                                        Jadwal Bimbingan
                                    </h3>
                                    <p class="feature-text">Lihat dan atur jadwal bimbingan Anda dengan dosen pembimbing</p>
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
                                        <i class="fas fa-user-tie me-2"></i>
                                        Dosen Pembimbing
                                    </h3>
                                    <p class="feature-text">Lihat informasi dan kontak dosen pembimbing Anda</p>
                                    <a href="{{ route('dosen.index') }}" class="btn btn-success btn-custom">
                                        <i class="fas fa-arrow-right me-2"></i>Lihat Dosen
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