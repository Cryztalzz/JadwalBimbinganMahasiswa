@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Form Penilaian Bimbingan</h5>
                </div>

                <div class="card-body">
                    <div class="mb-4">
                        <h6>Informasi Bimbingan</h6>
                        <p><strong>Mahasiswa:</strong> {{ $jadwal->mahasiswa->nama }} ({{ $jadwal->mahasiswa->nim }})</p>
                        <p><strong>Tanggal:</strong> {{ $jadwal->tanggal }}</p>
                        <p><strong>Waktu:</strong> {{ $jadwal->waktu_mulai }} - {{ $jadwal->waktu_selesai }}</p>
                        <p><strong>Topik:</strong> {{ $jadwal->topik }}</p>
                    </div>

                    <form action="{{ route('penilaian.store', $jadwal->id_jadwal) }}" method="POST">
                        @csrf
                        
                        <div class="mb-3">
                            <label for="catatan_bimbingan" class="form-label">Catatan Bimbingan</label>
                            <textarea class="form-control @error('catatan_bimbingan') is-invalid @enderror" 
                                id="catatan_bimbingan" name="catatan_bimbingan" rows="3" required>{{ old('catatan_bimbingan') }}</textarea>
                            @error('catatan_bimbingan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="nilai_kehadiran" class="form-label">Nilai Kehadiran</label>
                                <select class="form-select @error('nilai_kehadiran') is-invalid @enderror" 
                                    id="nilai_kehadiran" name="nilai_kehadiran" required>
                                    <option value="">Pilih Nilai</option>
                                    @for($i = 1; $i <= 5; $i++)
                                        <option value="{{ $i }}" {{ old('nilai_kehadiran') == $i ? 'selected' : '' }}>
                                            {{ $i }}
                                        </option>
                                    @endfor
                                </select>
                                @error('nilai_kehadiran')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label for="nilai_kesiapan" class="form-label">Nilai Kesiapan</label>
                                <select class="form-select @error('nilai_kesiapan') is-invalid @enderror" 
                                    id="nilai_kesiapan" name="nilai_kesiapan" required>
                                    <option value="">Pilih Nilai</option>
                                    @for($i = 1; $i <= 5; $i++)
                                        <option value="{{ $i }}" {{ old('nilai_kesiapan') == $i ? 'selected' : '' }}>
                                            {{ $i }}
                                        </option>
                                    @endfor
                                </select>
                                @error('nilai_kesiapan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label for="nilai_kemajuan" class="form-label">Nilai Kemajuan</label>
                                <select class="form-select @error('nilai_kemajuan') is-invalid @enderror" 
                                    id="nilai_kemajuan" name="nilai_kemajuan" required>
                                    <option value="">Pilih Nilai</option>
                                    @for($i = 1; $i <= 5; $i++)
                                        <option value="{{ $i }}" {{ old('nilai_kemajuan') == $i ? 'selected' : '' }}>
                                            {{ $i }}
                                        </option>
                                    @endfor
                                </select>
                                @error('nilai_kemajuan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="feedback" class="form-label">Feedback</label>
                            <textarea class="form-control @error('feedback') is-invalid @enderror" 
                                id="feedback" name="feedback" rows="3">{{ old('feedback') }}</textarea>
                            @error('feedback')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="rencana_tindak_lanjut" class="form-label">Rencana Tindak Lanjut</label>
                            <textarea class="form-control @error('rencana_tindak_lanjut') is-invalid @enderror" 
                                id="rencana_tindak_lanjut" name="rencana_tindak_lanjut" rows="3">{{ old('rencana_tindak_lanjut') }}</textarea>
                            @error('rencana_tindak_lanjut')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('dosen.jadwal') }}" class="btn btn-secondary">Kembali</a>
                            <button type="submit" class="btn btn-primary">Simpan Penilaian</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 