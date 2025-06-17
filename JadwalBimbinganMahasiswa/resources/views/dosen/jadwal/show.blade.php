@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Detail Bimbingan</h4>
            <div>
                <a href="{{ route('dosen.jadwal') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
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

            <div class="row">
                <div class="col-md-6">
                    <table class="table">
                        <tr>
                            <th width="200">Tanggal</th>
                            <td>{{ \Carbon\Carbon::parse($jadwal->tanggal)->format('d/m/Y') }}</td>
                        </tr>
                        <tr>
                            <th>Waktu</th>
                            <td>{{ \Carbon\Carbon::parse($jadwal->waktu_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($jadwal->waktu_selesai)->format('H:i') }}</td>
                        </tr>
                        <tr>
                            <th>Mahasiswa</th>
                            <td>{{ $jadwal->mahasiswa->nama }} ({{ $jadwal->mahasiswa->nim }})</td>
                        </tr>
                        <tr>
                            <th>Jurusan</th>
                            <td>{{ $jadwal->mahasiswa->jurusan }}</td>
                        </tr>
                        <tr>
                            <th>Topik</th>
                            <td>{{ $jadwal->topik }}</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>
                                @if($jadwal->status == 'menunggu_persetujuan')
                                    <span class="badge bg-warning">Menunggu Persetujuan</span>
                                @elseif($jadwal->status == 'disetujui')
                                    <span class="badge bg-success">Disetujui</span>
                                @elseif($jadwal->status == 'ditolak')
                                    <span class="badge bg-danger">Ditolak</span>
                                @elseif($jadwal->status == 'dibatalkan')
                                    <span class="badge bg-secondary">Dibatalkan</span>
                                @elseif($jadwal->status == 'selesai')
                                    <span class="badge bg-info">Selesai</span>
                                @else
                                    <span class="badge bg-dark">{{ ucfirst($jadwal->status) }}</span>
                                @endif
                            </td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="mt-4">
                @if($jadwal->status == 'menunggu_persetujuan')
                    <form action="{{ route('dosen.jadwal.approve', $jadwal->id_jadwal) }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-check me-1"></i>Setujui
                        </button>
                    </form>
                    <form action="{{ route('dosen.jadwal.reject', $jadwal->id_jadwal) }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menolak jadwal ini?')">
                            <i class="fas fa-times me-1"></i>Tolak
                        </button>
                    </form>
                @endif

                @if($jadwal->status == 'disetujui')
                    <form action="{{ route('jadwal-bimbingan.mark-as-selesai', $jadwal->id_jadwal) }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-success" onclick="return confirm('Apakah Anda yakin ingin menandai jadwal ini sebagai selesai?')">
                            <i class="fas fa-check me-1"></i>Tandai Selesai
                        </button>
                    </form>
                @endif

                @if($jadwal->status == 'selesai' && !$jadwal->penilaianBimbingan)
                    <a href="{{ route('penilaian.create', $jadwal->id_jadwal) }}" class="btn btn-primary">
                        <i class="fas fa-star me-1"></i>Beri Penilaian
                    </a>
                @endif

                @if($jadwal->penilaianBimbingan)
                    <a href="{{ route('penilaian.show', $jadwal->id_jadwal) }}" class="btn btn-info">
                        <i class="fas fa-eye me-1"></i>Lihat Penilaian
                    </a>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection 