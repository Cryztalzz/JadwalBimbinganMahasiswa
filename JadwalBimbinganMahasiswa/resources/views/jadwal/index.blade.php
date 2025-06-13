@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">
                        <i class="fas fa-calendar-alt me-2"></i>
                        Jadwal Bimbingan
                    </h5>
                    <a href="{{ route('jadwal.create') }}" class="btn btn-primary btn-custom">Tambah Jadwal</a>
                </div>

                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Mahasiswa</th>
                                    <th>Dosen</th>
                                    <th>Tanggal</th>
                                    <th>Waktu</th>
                                    <th>Topik</th>
                                    <th>Status</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($jadwal as $key => $j)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $j->mahasiswa->nama }}</td>
                                    <td>{{ $j->dosen->nama }}</td>
                                    <td>{{ $j->tanggal }}</td>
                                    <td>{{ $j->waktu_mulai }} - {{ $j->waktu_selesai }}</td>
                                    <td>{{ $j->topik }}</td>
                                    <td>
                                        <span class="status-badge status-{{ strtolower(str_replace(' ', '-', $j->status)) }}">
                                            {{ ucfirst($j->status) }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('jadwal.show', $j->id) }}" class="btn btn-info btn-sm me-1">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('jadwal.edit', $j->id) }}" class="btn btn-warning btn-sm me-1">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('jadwal.destroy', $j->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 