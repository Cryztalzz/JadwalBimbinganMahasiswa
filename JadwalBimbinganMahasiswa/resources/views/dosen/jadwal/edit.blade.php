@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Jadwal Bimbingan</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('dosen.jadwal.update', ['id' => $jadwal->id_jadwal]) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="tanggal" class="form-label">Tanggal</label>
                            <input type="text" class="form-control @error('tanggal') is-invalid @enderror" 
                                id="tanggal" value="{{ \Carbon\Carbon::parse($jadwal->tanggal)->format('d/m/Y') }}" readonly>
                            @error('tanggal')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="waktu_mulai" class="form-label">Waktu Mulai</label>
                            <input type="text" class="form-control @error('waktu_mulai') is-invalid @enderror" 
                                id="waktu_mulai" value="{{ \Carbon\Carbon::parse($jadwal->waktu_mulai)->format('H:i') }}" readonly>
                            @error('waktu_mulai')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="waktu_selesai" class="form-label">Waktu Selesai</label>
                            <input type="text" class="form-control @error('waktu_selesai') is-invalid @enderror" 
                                id="waktu_selesai" value="{{ \Carbon\Carbon::parse($jadwal->waktu_selesai)->format('H:i') }}" readonly>
                            @error('waktu_selesai')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="mahasiswa" class="form-label">Mahasiswa</label>
                            <input type="text" class="form-control" value="{{ $jadwal->mahasiswa->nama }}" readonly>
                        </div>

                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select @error('status') is-invalid @enderror" id="status" name="status">
                                <option value="menunggu_persetujuan" {{ old('status', $jadwal->status) == 'menunggu_persetujuan' ? 'selected' : '' }}>Menunggu Persetujuan</option>
                                <option value="disetujui" {{ old('status', $jadwal->status) == 'disetujui' ? 'selected' : '' }}>Disetujui</option>
                                <option value="ditolak" {{ old('status', $jadwal->status) == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('dosen.jadwal') }}" class="btn btn-secondary">Kembali</a>
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 