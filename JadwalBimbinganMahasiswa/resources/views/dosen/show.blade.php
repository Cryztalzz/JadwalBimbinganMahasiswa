@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">
                        <i class="fas fa-user-tie me-2"></i>
                        Detail Dosen
                    </h5>
                    <div>
                        <a href="{{ route('dosen.edit', $dosen->id) }}" class="btn btn-warning btn-custom btn-sm me-1">Edit</a>
                        <a href="{{ route('dosen.index') }}" class="btn btn-secondary btn-custom btn-sm">Kembali</a>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold">NIP</div>
                        <div class="col-md-8">{{ $dosen->nip }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold">Nama</div>
                        <div class="col-md-8">{{ $dosen->nama }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold">Email</div>
                        <div class="col-md-8">{{ $dosen->email }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold">Bidang Keahlian</div>
                        <div class="col-md-8">{{ $dosen->bidang_keahlian }}</div>
                    </div>

                    <h5 class="mt-4 mb-3 card-header-custom">
                        <i class="fas fa-calendar-alt me-2"></i>
                        Jadwal Bimbingan
                    </h5>
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Mahasiswa</th>
                                    <th>Tanggal</th>
                                    <th>Waktu</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($dosen->jadwalBimbingan as $key => $jadwal)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $jadwal->mahasiswa->nama }}</td>
                                    <td>{{ $jadwal->tanggal }}</td>
                                    <td>{{ $jadwal->waktu_mulai }} - {{ $jadwal->waktu_selesai }}</td>
                                    <td>
                                        <span class="status-badge status-{{ strtolower(str_replace(' ', '-', $jadwal->status)) }}">
                                            {{ ucfirst($jadwal->status) }}
                                        </span>
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