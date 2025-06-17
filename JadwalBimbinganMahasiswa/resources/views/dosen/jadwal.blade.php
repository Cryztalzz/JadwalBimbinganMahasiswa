@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Jadwal Bimbingan</h5>
                    <a href="{{ route('dosen.dashboard') }}" class="btn btn-primary">
                        <i class="fas fa-arrow-left me-2"></i>Kembali ke Dashboard
                    </a>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="table-light">
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
                                    <td>{{ $j->mahasiswa->nama }} ({{ $j->mahasiswa->nim }})</td>
                                    <td>{{ $j->mahasiswa->jurusan }}</td>
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
                                        @elseif($j->status == 'selesai')
                                            <span class="badge bg-info">Selesai</span>
                                        @else
                                            <span class="badge bg-dark">{{ ucfirst($j->status) }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($j->status == 'menunggu_persetujuan')
                                            <form action="{{ route('dosen.jadwal.approve', $j->id_jadwal) }}" method="POST" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-success btn-sm">
                                                    <i class="fas fa-check me-1"></i>Setujui
                                                </button>
                                            </form>
                                            <form action="{{ route('dosen.jadwal.reject', $j->id_jadwal) }}" method="POST" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menolak jadwal ini?')">
                                                    <i class="fas fa-times me-1"></i>Tolak
                                                </button>
                                            </form>
                                        @endif
                                        @if($j->status == 'disetujui')
                                            <form action="{{ route('jadwal-bimbingan.mark-as-selesai', $j->id_jadwal) }}" method="POST" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-success btn-sm" onclick="return confirm('Apakah Anda yakin ingin menandai jadwal ini sebagai selesai?')">
                                                    <i class="fas fa-check me-1"></i>Tandai Selesai
                                                </button>
                                            </form>
                                        @endif
                                        @if($j->status == 'selesai' && !$j->penilaianBimbingan)
                                            <a href="{{ route('penilaian.create', $j->id_jadwal) }}" class="btn btn-primary btn-sm">
                                                <i class="fas fa-star me-1"></i>Beri Penilaian
                                            </a>
                                        @endif
                                        @if($j->penilaianBimbingan)
                                            <a href="{{ route('penilaian.show', $j->id_jadwal) }}" class="btn btn-info btn-sm">
                                                <i class="fas fa-eye me-1"></i>Lihat Penilaian
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
@endsection 