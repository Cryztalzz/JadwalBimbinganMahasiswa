@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Beri Penilaian Bimbingan</h4>
            <div>
                <a href="{{ url()->previous() }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>
        </div>
        <div class="card-body">
            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('penilaian.store', $jadwal->id_jadwal) }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Mahasiswa</label>
                            <input type="text" class="form-control" value="{{ $jadwal->mahasiswa->nama }} ({{ $jadwal->mahasiswa->nim }})" readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Tanggal Bimbingan</label>
                            <input type="text" class="form-control" value="{{ \Carbon\Carbon::parse($jadwal->tanggal)->format('d/m/Y') }}" readonly>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="aktivitas_mahasiswa" class="form-label">Aktivitas Mahasiswa</label>
                    <select class="form-select @error('aktivitas_mahasiswa') is-invalid @enderror" id="aktivitas_mahasiswa" name="aktivitas_mahasiswa" required>
                        <option value="">Pilih Aktivitas</option>
                        <option value="Aktif" {{ old('aktivitas_mahasiswa') == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="Cukup Aktif" {{ old('aktivitas_mahasiswa') == 'Cukup Aktif' ? 'selected' : '' }}>Cukup Aktif</option>
                        <option value="Kurang Aktif" {{ old('aktivitas_mahasiswa') == 'Kurang Aktif' ? 'selected' : '' }}>Kurang Aktif</option>
                    </select>
                    @error('aktivitas_mahasiswa')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="keterangan" class="form-label">Keterangan (Opsional)</label>
                    <textarea class="form-control @error('keterangan') is-invalid @enderror" id="keterangan" name="keterangan" rows="3">{{ old('keterangan') }}</textarea>
                    @error('keterangan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i>Simpan Penilaian
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection 