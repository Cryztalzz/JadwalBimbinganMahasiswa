@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h4 class="card-title mb-0">Selamat Datang, {{ $mahasiswa->nama }}</h4>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm border-0 bg-primary text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title mb-0">Total Jadwal</h6>
                            <h2 class="mt-2 mb-0">{{ $totalJadwal }}</h2>
                        </div>
                        <div class="fs-1">
                            <i class="fas fa-calendar-alt"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card shadow-sm border-0 bg-success text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title mb-0">Jadwal Hari Ini</h6>
                            <h2 class="mt-2 mb-0">{{ $jadwalHariIni }}</h2>
                        </div>
                        <div class="fs-1">
                            <i class="fas fa-calendar-day"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card shadow-sm border-0 bg-info text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title mb-0">Jadwal Minggu Ini</h6>
                            <h2 class="mt-2 mb-0">{{ $jadwalMingguIni }}</h2>
                        </div>
                        <div class="fs-1">
                            <i class="fas fa-calendar-week"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Jadwal Bimbingan Terbaru</h5>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#buatJadwalModal">
                        <i class="fas fa-plus"></i> Buat Jadwal Baru
                    </button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Waktu</th>
                                    <th>Dosen</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($jadwalBimbingan as $jadwal)
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($jadwal->tanggal)->format('d/m/Y') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($jadwal->waktu_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($jadwal->waktu_selesai)->format('H:i') }}</td>
                                    <td>{{ $jadwal->dosen->nama_dosen }}</td>
                                    <td>
                                        <span class="badge bg-{{ $jadwal->status == 'menunggu_persetujuan' ? 'warning' : ($jadwal->status == 'disetujui' ? 'success' : 'danger') }}">
                                            {{ $jadwal->status == 'menunggu_persetujuan' ? 'Menunggu Persetujuan' : ($jadwal->status == 'disetujui' ? 'Disetujui' : 'Ditolak') }}
                                        </span>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center">Tidak ada jadwal bimbingan</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Buat Jadwal -->
<div class="modal fade" id="buatJadwalModal" tabindex="-1" aria-labelledby="buatJadwalModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="buatJadwalModalLabel">Buat Jadwal Bimbingan Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('mahasiswa.jadwal.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="id_dosen" class="form-label">Dosen</label>
                        <select class="form-select @error('id_dosen') is-invalid @enderror" id="id_dosen" name="id_dosen" required>
                            <option value="">Pilih Dosen</option>
                            @foreach($dosen as $d)
                                <option value="{{ $d->id_dosen }}" {{ old('id_dosen') == $d->id_dosen ? 'selected' : '' }}>
                                    {{ $d->nama_dosen }} ({{ $d->nip }})
                                </option>
                            @endforeach
                        </select>
                        @error('id_dosen')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="tanggal" class="form-label">Tanggal</label>
                        <input type="date" class="form-control @error('tanggal') is-invalid @enderror" 
                            id="tanggal" name="tanggal" 
                            value="{{ old('tanggal', date('Y-m-d')) }}" 
                            min="{{ date('Y-m-d') }}"
                            required>
                        @error('tanggal')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="waktu_mulai" class="form-label">Waktu Mulai</label>
                        <input type="time" class="form-control @error('waktu_mulai') is-invalid @enderror" 
                            id="waktu_mulai" name="waktu_mulai" 
                            value="{{ old('waktu_mulai', '09:00') }}"
                            min="08:00" max="17:00"
                            required>
                        @error('waktu_mulai')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="waktu_selesai" class="form-label">Waktu Selesai</label>
                        <input type="time" class="form-control @error('waktu_selesai') is-invalid @enderror" 
                            id="waktu_selesai" name="waktu_selesai" 
                            value="{{ old('waktu_selesai', '10:00') }}"
                            min="08:00" max="17:00"
                            required>
                        @error('waktu_selesai')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection