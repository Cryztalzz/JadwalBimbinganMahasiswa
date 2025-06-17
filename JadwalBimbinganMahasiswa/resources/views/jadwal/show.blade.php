@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">
                        <i class="fas fa-calendar-alt me-2"></i>
                        Detail Jadwal Bimbingan
                    </h5>
                    <div>
                        @if($jadwal->status === 'selesai' && !$jadwal->penilaianBimbingan)
                            <a href="{{ route('penilaian.create', $jadwal->id_jadwal) }}" class="btn btn-success btn-custom btn-sm me-1">
                                <i class="fas fa-star me-1"></i>Beri Penilaian
                            </a>
                        @endif
                        <a href="{{ route('jadwal.edit', $jadwal->id_jadwal) }}" class="btn btn-warning btn-custom btn-sm me-1">Edit</a>
                        <a href="{{ route('jadwal.index') }}" class="btn btn-secondary btn-custom btn-sm">Kembali</a>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold">Mahasiswa</div>
                        <div class="col-md-8">{{ $jadwal->mahasiswa->nama }} ({{ $jadwal->mahasiswa->nim }})</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold">Dosen</div>
                        <div class="col-md-8">{{ $jadwal->dosen->nama }} ({{ $jadwal->dosen->nip }})</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold">Tanggal</div>
                        <div class="col-md-8">{{ $jadwal->tanggal }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold">Waktu</div>
                        <div class="col-md-8">{{ $jadwal->waktu_mulai }} - {{ $jadwal->waktu_selesai }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold">Topik</div>
                        <div class="col-md-8">{{ $jadwal->topik }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold">Status</div>
                        <div class="col-md-8">
                            <span class="status-badge status-{{ strtolower(str_replace(' ', '-', $jadwal->status)) }}">
                                {{ ucfirst($jadwal->status) }}
                            </span>
                        </div>
                    </div>

                    @if($jadwal->penilaianBimbingan)
                        <hr>
                        <h5 class="mb-3">Penilaian Bimbingan</h5>
                        <div class="row mb-3">
                            <div class="col-md-4 fw-bold">Nilai</div>
                            <div class="col-md-8">
                                @switch($jadwal->penilaianBimbingan->nilai)
                                    @case(1)
                                        Sangat Kurang
                                        @break
                                    @case(2)
                                        Kurang
                                        @break
                                    @case(3)
                                        Cukup
                                        @break
                                    @case(4)
                                        Baik
                                        @break
                                    @case(5)
                                        Sangat Baik
                                        @break
                                @endswitch
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4 fw-bold">Komentar</div>
                            <div class="col-md-8">{{ $jadwal->penilaianBimbingan->komentar ?? '-' }}</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4 fw-bold">Tanggal Penilaian</div>
                            <div class="col-md-8">{{ $jadwal->penilaianBimbingan->tanggal_penilaian->format('d F Y') }}</div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 