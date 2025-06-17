@extends('layouts.app')

@section('content')
<style>
    /* Menghilangkan arrow up/down pada input number */
    input[type="number"]::-webkit-inner-spin-button,
    input[type="number"]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
    input[type="number"] {
        -moz-appearance: textfield;
    }
</style>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">
                        <i class="fas fa-user-graduate me-2"></i>
                        Tambah Mahasiswa Baru
                    </h5>
                    <a href="{{ route('admin.mahasiswa.index') }}" class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left me-1"></i> Kembali
                    </a>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('admin.mahasiswa.store') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required pattern="[A-Za-z\s]+" title="Hanya huruf dan spasi yang diperbolehkan">
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required pattern="[^@]+@[^@]+\.[^@]+" title="Email harus mengandung @ dan domain (contoh: nama@domain.com)">
                            <small class="text-muted">Username akan otomatis dibuat dari email (bagian sebelum @)</small>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required minlength="8">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="nim" class="form-label">NIM</label>
                            <input type="number" class="form-control @error('nim') is-invalid @enderror" id="nim" name="nim" value="{{ old('nim') }}" required minlength="8" maxlength="15" title="NIM harus terdiri dari 8-15 angka">
                            @error('nim')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="jurusan" class="form-label">Jurusan</label>
                            <input type="text" class="form-control @error('jurusan') is-invalid @enderror" id="jurusan" name="jurusan" value="{{ old('jurusan') }}" required pattern="[A-Za-z\s]+" title="Hanya huruf dan spasi yang diperbolehkan">
                            @error('jurusan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="angkatan" class="form-label">Angkatan</label>
                            <input type="number" class="form-control @error('angkatan') is-invalid @enderror" id="angkatan" name="angkatan" value="{{ old('angkatan') }}" required min="2000" max="{{ date('Y') + 1 }}">
                            @error('angkatan')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="notelp" class="form-label">Nomor Telepon</label>
                            <input type="number" class="form-control @error('notelp') is-invalid @enderror" id="notelp" name="notelp" value="{{ old('notelp') }}" required minlength="10" maxlength="15" pattern="^08[0-9]{8,13}$" title="Nomor telepon harus dimulai dengan 08 dan diikuti 8-13 digit angka">
                            @error('notelp')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-1"></i> Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 