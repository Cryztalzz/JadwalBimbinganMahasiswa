@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h4 class="card-title mb-0">Selamat Datang, {{ auth()->user()->mahasiswa->nama }}</h4>
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
                            <h2 class="mt-2 mb-0">{{ $jadwalBimbingan->count() }}</h2>
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
                            <h2 class="mt-2 mb-0">{{ $jadwalBimbingan->where('tanggal', date('Y-m-d'))->count() }}</h2>
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
                            <h2 class="mt-2 mb-0">{{ $jadwalBimbingan->whereBetween('tanggal', [now()->startOfWeek(), now()->endOfWeek()])->count() }}</h2>
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
                    <div>
                        <a href="{{ route('jadwal-bimbingan.index') }}" class="btn btn-info btn-custom me-2">
                            <i class="fas fa-list-alt"></i> Lihat Semua Jadwal
                        </a>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#buatJadwalModal">
                            <i class="fas fa-plus"></i> Buat Jadwal Baru
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Waktu</th>
                                    <th>Dosen</th>
                                    <th>Topik</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($jadwalBimbingan as $jadwal)
                                <tr>
                                        <td>{{ $loop->iteration }}</td>
                                    <td>{{ \Carbon\Carbon::parse($jadwal->tanggal)->format('d/m/Y') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($jadwal->waktu_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($jadwal->waktu_selesai)->format('H:i') }}</td>
                                    <td>{{ $jadwal->dosen->nama_dosen }}</td>
                                    <td>{{ $jadwal->topik }}</td>
                                    <td>
                                        @if($jadwal->status === 'menunggu_persetujuan')
                                            <span class="badge bg-warning">Menunggu Persetujuan</span>
                                        @elseif($jadwal->status === 'disetujui')
                                            <span class="badge bg-success">Disetujui</span>
                                        @elseif($jadwal->status === 'ditolak')
                                            <span class="badge bg-danger">Ditolak</span>
                                        @elseif($jadwal->status === 'dibatalkan')
                                            <span class="badge bg-secondary">Dibatalkan</span>
                                        @elseif($jadwal->status === 'selesai')
                                            <span class="badge bg-info">Selesai</span>
                                        @else
                                            <span class="badge bg-dark">{{ ucfirst($jadwal->status) }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($jadwal->status == 'menunggu_persetujuan')
                                            <form action="{{ route('jadwal-bimbingan.cancel', $jadwal->id_jadwal) }}" method="POST" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin membatalkan jadwal ini?')">
                                                    <i class="fas fa-times me-1"></i>Batalkan
                                                </button>
                                            </form>
                                        @endif
                                        @if($jadwal->status == 'selesai' && !$jadwal->penilaianMahasiswa)
                                            <a href="{{ route('mahasiswa.penilaian.create', $jadwal->id_jadwal) }}" class="btn btn-primary btn-sm">
                                                <i class="fas fa-star"></i> Beri Penilaian
                                            </a>
                                        @endif
                                        @if($jadwal->penilaianMahasiswa)
                                            <a href="{{ route('mahasiswa.penilaian.show', $jadwal->id_jadwal) }}" class="btn btn-info btn-sm">
                                                <i class="fas fa-eye"></i> Lihat Penilaian
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                        <td colspan="7" class="text-center">Tidak ada jadwal bimbingan</td>
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
            <form action="{{ route('jadwal-bimbingan.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="dosen_id" class="form-label">Dosen</label>
                        <select class="form-select @error('dosen_id') is-invalid @enderror" id="dosen_id" name="dosen_id" required>
                            <option value="">Pilih Dosen</option>
                            @foreach($dosen as $d)
                                    <option value="{{ $d->id_dosen }}" {{ old('dosen_id') == $d->id_dosen ? 'selected' : '' }}>
                                        {{ $d->nama_dosen }} ({{ $d->nip }})
                                    </option>
                            @endforeach
                        </select>
                        @error('dosen_id')
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
                    <div class="mb-3">
                        <label for="topik" class="form-label">Topik Bimbingan</label>
                        <input type="text" class="form-control @error('topik') is-invalid @enderror" 
                            id="topik" name="topik" 
                            value="{{ old('topik') }}" 
                            required>
                        @error('topik')
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