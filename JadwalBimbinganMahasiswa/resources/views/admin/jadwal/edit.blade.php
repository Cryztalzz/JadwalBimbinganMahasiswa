@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Edit Jadwal Bimbingan</h5>
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.jadwal.update', $jadwal->id_jadwal) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-3">
                            <label for="id_dosen" class="form-label">Dosen</label>
                            <select class="form-select @error('id_dosen') is-invalid @enderror" id="id_dosen" name="id_dosen" required>
                                <option value="">Pilih Dosen</option>
                                @foreach($dosen as $d)
                                    <option value="{{ $d->id_dosen }}" {{ old('id_dosen', $jadwal->id_dosen) == $d->id_dosen ? 'selected' : '' }}>
                                        {{ $d->nama_dosen }} ({{ $d->nip }})
                                    </option>
                                @endforeach
                            </select>
                            @error('id_dosen')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="nim" class="form-label">Mahasiswa</label>
                            <select class="form-select @error('nim') is-invalid @enderror" id="nim" name="nim" required>
                                <option value="">Pilih Mahasiswa</option>
                                @foreach($mahasiswa as $m)
                                    <option value="{{ $m->nim }}" {{ old('nim', $jadwal->nim) == $m->nim ? 'selected' : '' }}>
                                        {{ $m->nama }} ({{ $m->nim }})
                                    </option>
                                @endforeach
                            </select>
                            @error('nim')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="tanggal" class="form-label">Tanggal</label>
                            <input type="date" class="form-control @error('tanggal') is-invalid @enderror" id="tanggal" name="tanggal" value="{{ old('tanggal', $jadwal->tanggal->format('Y-m-d')) }}" required>
                            @error('tanggal')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="waktu_mulai" class="form-label">Waktu Mulai</label>
                            <input type="time" class="form-control @error('waktu_mulai') is-invalid @enderror" id="waktu_mulai" name="waktu_mulai" value="{{ old('waktu_mulai', $jadwal->waktu_mulai->format('H:i')) }}" required>
                            @error('waktu_mulai')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="waktu_selesai" class="form-label">Waktu Selesai</label>
                            <input type="time" class="form-control @error('waktu_selesai') is-invalid @enderror" id="waktu_selesai" name="waktu_selesai" value="{{ old('waktu_selesai', $jadwal->waktu_selesai->format('H:i')) }}" required>
                            @error('waktu_selesai')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                                <option value="menunggu_persetujuan" {{ old('status', $jadwal->status) == 'menunggu_persetujuan' ? 'selected' : '' }}>Menunggu Persetujuan</option>
                                <option value="disetujui" {{ old('status', $jadwal->status) == 'disetujui' ? 'selected' : '' }}>Disetujui</option>
                                <option value="ditolak" {{ old('status', $jadwal->status) == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.jadwal.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-1"></i> Kembali
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-1"></i> Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 