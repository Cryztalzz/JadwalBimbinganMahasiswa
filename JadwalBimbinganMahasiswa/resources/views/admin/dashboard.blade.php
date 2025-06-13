@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Dashboard Admin</div>

                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-4">
                            <div class="card bg-primary text-white">
                                <div class="card-body">
                                    <h5 class="card-title">Total Dosen</h5>
                                    <h2 class="card-text">{{ $totalDosen }}</h2>
                                    <a href="{{ route('admin.dosen.index') }}" class="btn btn-light">Kelola Dosen</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card bg-success text-white">
                                <div class="card-body">
                                    <h5 class="card-title">Total Mahasiswa</h5>
                                    <h2 class="card-text">{{ $totalMahasiswa }}</h2>
                                    <a href="{{ route('admin.mahasiswa.index') }}" class="btn btn-light">Kelola Mahasiswa</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card bg-info text-white">
                                <div class="card-body">
                                    <h5 class="card-title">Total Jadwal</h5>
                                    <h2 class="card-text">{{ $totalJadwal }}</h2>
                                    <a href="{{ route('admin.jadwal.index') }}" class="btn btn-light">Kelola Jadwal</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">Menu Cepat</div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <a href="{{ route('admin.dosen.create') }}" class="btn btn-primary btn-block mb-2">Tambah Dosen Baru</a>
                                        </div>
                                        <div class="col-md-4">
                                            <a href="{{ route('admin.mahasiswa.create') }}" class="btn btn-success btn-block mb-2">Tambah Mahasiswa Baru</a>
                                        </div>
                                        <div class="col-md-4">
                                            <a href="{{ route('admin.jadwal.create') }}" class="btn btn-info btn-block mb-2">Buat Jadwal Baru</a>
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
@endsection 