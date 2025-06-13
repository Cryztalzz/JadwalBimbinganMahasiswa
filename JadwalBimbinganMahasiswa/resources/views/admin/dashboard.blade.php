@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">
                        <i class="fas fa-tachometer-alt me-2"></i>
                        Dashboard Admin
                    </h4>
                </div>
                <div class="card-body">
                    <div class="row mt-4">
                        <div class="col-md-4">
                            <div class="card bg-primary text-white h-100">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h5 class="card-title">
                                                <i class="fas fa-chalkboard-teacher me-2"></i>
                                                Total Dosen
                                            </h5>
                                            <h2 class="mt-3 mb-4">{{ $totalDosen }}</h2>
                                            <a href="{{ route('admin.dosen.index') }}" class="btn btn-dashboard-admin btn-dashboard-primary w-100">
                                                <i class="fas fa-cog me-2"></i>Kelola Dosen
                                            </a>
                                        </div>
                                        <div class="fs-1 opacity-50">
                                            <i class="fas fa-chalkboard-teacher"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card bg-success text-white h-100">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h5 class="card-title">
                                                <i class="fas fa-user-graduate me-2"></i>
                                                Total Mahasiswa
                                            </h5>
                                            <h2 class="mt-3 mb-4">{{ $totalMahasiswa }}</h2>
                                            <a href="{{ route('admin.mahasiswa.index') }}" class="btn btn-dashboard-admin btn-dashboard-success w-100">
                                                <i class="fas fa-cog me-2"></i>Kelola Mahasiswa
                                            </a>
                                        </div>
                                        <div class="fs-1 opacity-50">
                                            <i class="fas fa-user-graduate"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card bg-info text-white h-100">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h5 class="card-title">
                                                <i class="fas fa-calendar-alt me-2"></i>
                                                Total Jadwal
                                            </h5>
                                            <h2 class="mt-3 mb-4">{{ $totalJadwal }}</h2>
                                            <a href="{{ route('admin.jadwal.index') }}" class="btn btn-dashboard-admin btn-dashboard-info w-100">
                                                <i class="fas fa-cog me-2"></i>Kelola Jadwal
                                            </a>
                                        </div>
                                        <div class="fs-1 opacity-50">
                                            <i class="fas fa-calendar-alt"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .btn-primary:hover, .btn-success:hover, .btn-info:hover {
        background: rgba(255, 255, 255, 0.3) !important;
        border-color: rgba(255, 255, 255, 0.6) !important;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
    }
</style>
@endsection 