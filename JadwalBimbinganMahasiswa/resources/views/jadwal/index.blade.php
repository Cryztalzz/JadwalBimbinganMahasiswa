@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Jadwal Bimbingan</h4>
            <a href="{{ route('jadwal-bimbingan.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-2"></i>Buat Jadwal Baru
            </a>
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
                                <td>{{ $j->waktu_mulai }} - {{ $j->waktu_selesai }}</td>
                                <td>{{ $j->dosen->nama }}</td>
                                <td>{{ $j->topik }}</td>
                                <td>
                                    @if($j->status == 'menunggu')
                                        <span class="badge bg-warning">Menunggu</span>
                                    @elseif($j->status == 'diterima')
                                        <span class="badge bg-success">Diterima</span>
                                    @elseif($j->status == 'ditolak')
                                        <span class="badge bg-danger">Ditolak</span>
                                    @elseif($j->status == 'dibatalkan')
                                        <span class="badge bg-secondary">Dibatalkan</span>
                                    @endif
                                </td>
                                <td>
                                    @if($j->status == 'menunggu')
                                        <form action="{{ route('jadwal-bimbingan.cancel', $j->id) }}" method="POST" class="d-inline">
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
@endsection 