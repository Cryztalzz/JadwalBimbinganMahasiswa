@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">
                        <i class="fas fa-calendar-alt me-2"></i>
                        Kelola Jadwal
                    </h5>
                    <div>
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary btn-custom btn-sm me-2">
                            <i class="fas fa-arrow-left me-1"></i> Kembali
                        </a>
                        <a href="{{ route('admin.jadwal.create') }}" class="btn btn-primary btn-custom btn-sm">
                            <i class="fas fa-plus me-1"></i> Tambah Jadwal
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Waktu</th>
                                    <th>Dosen</th>
                                    <th>Mahasiswa</th>
                                    <th>Topik</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($jadwal as $key => $j)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ \Carbon\Carbon::parse($j->tanggal)->format('d/m/Y') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($j->waktu_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($j->waktu_selesai)->format('H:i') }}</td>
                                    <td>{{ $j->dosen->nama_dosen }}</td>
                                    <td>{{ $j->mahasiswa->nama }}</td>
                                    <td>{{ $j->topik }}</td>
                                    <td>
                                        <span class="badge bg-{{ $j->status == 'menunggu_persetujuan' ? 'warning' : ($j->status == 'disetujui' ? 'success' : 'danger') }}">
                                            {{ str_replace('_', ' ', ucfirst($j->status)) }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.jadwal.edit', $j->id_jadwal) }}" class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit me-1"></i> Edit
                                        </a>
                                        <form action="{{ route('admin.jadwal.destroy', $j->id_jadwal) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus jadwal ini?')">
                                                <i class="fas fa-trash me-1"></i> Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="8" class="text-center">Tidak ada data jadwal</td>
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