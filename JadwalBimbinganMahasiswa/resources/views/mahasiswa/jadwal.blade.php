@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Jadwal Bimbingan</h4>
            <div>
                <a href="{{ route('mahasiswa.dashboard') }}" class="btn btn-secondary me-2">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#buatJadwalModal">
                    <i class="fas fa-plus me-2"></i>Buat Jadwal Baru
                </button>
            </div>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Waktu</th>
                            <th>Dosen</th>
                            <th>Topik</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($jadwal as $j)
                            <tr>
                                <td>{{ $j->tanggal->format('d/m/Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($j->waktu_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($j->waktu_selesai)->format('H:i') }}</td>
                                <td>{{ $j->dosen->nama_dosen ?? '-' }}</td>
                                <td>{{ $j->topik }}</td>
                                <td>
                                    @if($j->status == 'menunggu_persetujuan')
                                        <span class="badge bg-warning">Menunggu Persetujuan</span>
                                    @elseif($j->status == 'disetujui')
                                        <span class="badge bg-success">Disetujui</span>
                                    @elseif($j->status == 'ditolak')
                                        <span class="badge bg-danger">Ditolak</span>
                                    @elseif($j->status == 'dibatalkan')
                                        <span class="badge bg-secondary">Dibatalkan</span>
                                    @else
                                        <span class="badge bg-info">{{ ucfirst(str_replace('_', ' ', $j->status ?? 'Tidak Diketahui')) }}</span>
                                    @endif
                                </td>
                                <td>
                                    @if($j->status == 'menunggu_persetujuan')
                                        <form action="{{ route('jadwal-bimbingan.cancel', $j->id_jadwal) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin membatalkan jadwal ini?')">
                                                <i class="fas fa-times me-1"></i>Batalkan
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Belum ada jadwal bimbingan</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
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
                        <label for="dosen_id" class="form-label">Dosen Pembimbing</label>
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
                        <input type="time" class="form-control @error('waktu_selesai') is-invalid @enderror" id="waktu_selesai" name="waktu_selesai" value="{{ old('waktu_selesai') }}" required>
                        @error('waktu_selesai')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="topik" class="form-label">Topik Bimbingan</label>
                        <textarea class="form-control @error('topik') is-invalid @enderror" id="topik" name="topik" rows="3" required>{{ old('topik') }}</textarea>
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