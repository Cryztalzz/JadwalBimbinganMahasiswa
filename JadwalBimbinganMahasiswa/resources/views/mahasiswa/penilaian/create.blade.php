@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Beri Penilaian Bimbingan</h5>
                    <a href="{{ route('jadwal-bimbingan.show', $jadwal->id_jadwal) }}" class="btn btn-secondary">Kembali</a>
                </div>
                <div class="card-body">
                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form action="{{ route('mahasiswa.penilaian.store', $jadwal->id_jadwal) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Dosen</label>
                            <input type="text" class="form-control" value="{{ $jadwal->dosen->nama_dosen }}" readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Tanggal Bimbingan</label>
                            <input type="text" class="form-control" value="{{ \Carbon\Carbon::parse($jadwal->tanggal)->format('d/m/Y') }}" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="kualitas_bimbingan" class="form-label">Kualitas Bimbingan</label>
                            <select class="form-select @error('kualitas_bimbingan') is-invalid @enderror" id="kualitas_bimbingan" name="kualitas_bimbingan" required>
                                <option value="">Pilih Kualitas</option>
                                <option value="Sangat Baik" {{ old('kualitas_bimbingan') == 'Sangat Baik' ? 'selected' : '' }}>Sangat Baik</option>
                                <option value="Baik" {{ old('kualitas_bimbingan') == 'Baik' ? 'selected' : '' }}>Baik</option>
                                <option value="Cukup" {{ old('kualitas_bimbingan') == 'Cukup' ? 'selected' : '' }}>Cukup</option>
                                <option value="Kurang" {{ old('kualitas_bimbingan') == 'Kurang' ? 'selected' : '' }}>Kurang</option>
                                <option value="Sangat Kurang" {{ old('kualitas_bimbingan') == 'Sangat Kurang' ? 'selected' : '' }}>Sangat Kurang</option>
                            </select>
                            @error('kualitas_bimbingan')
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
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Simpan Penilaian</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 