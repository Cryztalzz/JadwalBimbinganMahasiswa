@extends('layouts.app')

@section('content')
<div class="container-fluid content">
    <div class="row">
        <div class="col-md-3">
            <div class="card mb-4">
                <div class="card-body text-center">
                    <img src="{{ $user['image'] }}" alt="Profile" class="profile-img rounded-circle mb-3" style="width: 80px; height: 80px; border: 3px solid var(--primary-color);">
                    <h5 class="card-title">{{ $user['name'] }}</h5>
                    <p class="card-text text-muted">Mahasiswa</p>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <i class="fas fa-bars me-2"></i>
                    Menu Navigasi
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <a href="#" class="sidebar-link text-decoration-none d-flex align-items-center">
                                <i class="fas fa-home me-2"></i>
                                Beranda
                            </a>
                        </li>
                        <li class="list-group-item">
                            <a href="{{ route('jadwal.index') }}" class="sidebar-link text-decoration-none d-flex align-items-center">
                                <i class="fas fa-calendar me-2"></i>
                                Jadwal Bimbingan
                            </a>
                        </li>
                        <li class="list-group-item">
                            <a href="{{ route('mahasiswa.index') }}" class="sidebar-link text-decoration-none d-flex align-items-center">
                                <i class="fas fa-users me-2"></i>
                                Mahasiswa
                            </a>
                        </li>
                        <li class="list-group-item">
                            <a href="{{ route('dosen.index') }}" class="sidebar-link text-decoration-none d-flex align-items-center">
                                <i class="fas fa-chalkboard-teacher me-2"></i>
                                Dosen
                            </a>
                        </li>
                        <li class="list-group-item">
                            <a href="#" class="sidebar-link text-decoration-none d-flex align-items-center">
                                <i class="fas fa-question-circle me-2"></i>
                                Bantuan
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-md-9">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-clock me-2"></i>
                    Jadwal Bimbingan Terbaru
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nama Mahasiswa</th>
                                    <th>Dosen</th>
                                    <th>Tanggal</th>
                                    <th>Waktu</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($jadwal_bimbingan as $jadwal)
                                <tr>
                                    <td>{{ $jadwal['id'] }}</td>
                                    <td>{{ $jadwal['nama_mahasiswa'] }}</td>
                                    <td>{{ $jadwal['dosen'] }}</td>
                                    <td>{{ $jadwal['tanggal'] }}</td>
                                    <td>{{ $jadwal['waktu'] }}</td>
                                    <td>
                                        <span class="status-badge status-{{ strtolower(str_replace(' ', '-', $jadwal['status'])) }}">
                                            {{ $jadwal['status'] }}
                                        </span>
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-info"><i class="fas fa-eye"></i></button>
                                        <button class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></button>
                                        <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .profile-img {
        object-fit: cover;
    }
    .list-group-item {
        border: none;
        padding: 0;
    }
    .list-group-item:first-child {
        border-top-left-radius: 0;
        border-top-right-radius: 0;
    }
    .list-group-item:last-child {
        border-bottom-left-radius: 0;
        border-bottom-right-radius: 0;
    }
    .status-badge {
        padding: 0.5em 0.8em;
        border-radius: 50px;
        font-weight: 600;
    }
    .status-diterima {
        background-color: #e3fcef;
        color: #00a854;
    }
    .status-menunggu {
        background-color: #fff7e6;
        color: #fa8c16;
    }
    .status-ditolak {
        background-color: #ffe6e6;
        color: #ff4d4f;
    }

    .content {
        padding-top: 80px; /* Adjust based on your fixed navbar height */
    }
</style>
@endpush 