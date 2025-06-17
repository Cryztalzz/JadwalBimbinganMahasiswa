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
                                    <td colspan="6" class="text-center">Tidak ada jadwal bimbingan</td>
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