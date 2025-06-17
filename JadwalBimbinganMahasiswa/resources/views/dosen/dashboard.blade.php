@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h4 class="card-title mb-0">Selamat Datang, {{ $dosen->nama_dosen }}</h4>
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
                    <a href="{{ route('dosen.jadwal') }}" class="btn btn-primary btn-sm">Lihat Semua Jadwal</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Waktu</th>
                                    <th>Mahasiswa</th>
                                    <th>Jurusan</th>
                                    <th>Topik</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($jadwal as $j)
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($j->tanggal)->format('d/m/Y') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($j->waktu_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($j->waktu_selesai)->format('H:i') }}</td>
                                    <td>{{ $j->mahasiswa->nama }}</td>
                                    <td>{{ $j->mahasiswa->jurusan }}</td>
                                    <td>{{ $j->topik }}</td>
                                    <td>
                                        @if($j->status == 'menunggu_persetujuan')
                                            <span class="badge bg-warning">Menunggu Persetujuan</span>
                                        @elseif($j->status == 'disetujui')
                                            <span class="badge bg-success">Disetujui</span>
                                        @elseif($j->status == 'dibatalkan')
                                            <span class="badge bg-secondary">Dibatalkan</span>
                                        @else
                                            <span class="badge bg-danger">Ditolak</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($j->status == 'menunggu_persetujuan')
                                            <form action="{{ route('dosen.jadwal.update', ['id' => $j->id_jadwal]) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="status" value="disetujui">
                                                <button type="submit" class="btn btn-sm btn-success" onclick="return confirm('Apakah Anda yakin ingin menyetujui jadwal bimbingan ini?')">
                                                    <i class="fas fa-check"></i> Setujui
                                                </button>
                                            </form>
                                            <form action="{{ route('dosen.jadwal.update', ['id' => $j->id_jadwal]) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="status" value="ditolak">
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menolak jadwal bimbingan ini?')">
                                                    <i class="fas fa-times"></i> Tolak
                                                </button>
                                            </form>
                                        @else
                                            <span class="text-muted">Tidak ada aksi</span>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center">Tidak ada jadwal bimbingan</td>
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
@endsection