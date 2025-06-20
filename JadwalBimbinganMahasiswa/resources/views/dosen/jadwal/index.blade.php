@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Jadwal Bimbingan</span>
                    <a href="{{ route('dosen.dashboard') }}" class="btn btn-secondary btn-sm">Kembali ke Dashboard</a>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
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
                                    <td>{{ $j->waktu_mulai }} - {{ $j->waktu_selesai }}</td>
                                    <td>{{ $j->mahasiswa->nama }}</td>
                                    <td>{{ $j->mahasiswa->jurusan }}</td>
                                    <td>{{ $j->topik }}</td>
                                    <td>
                                        @if($j->status == 'tersedia')
                                            <span class="badge bg-success">Tersedia</span>
                                        @elseif($j->status == 'menunggu_persetujuan')
                                            <span class="badge bg-warning">Menunggu Persetujuan</span>
                                        @else
                                            <span class="badge bg-info">Selesai</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('dosen.jadwal.edit', ['id' => $j->id_jadwal]) }}" class="btn btn-sm btn-primary">Edit</a>
                                        <form action="{{ route('dosen.jadwal.destroy', ['id' => $j->id_jadwal]) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus jadwal ini?')">Hapus</button>
                                        </form>
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