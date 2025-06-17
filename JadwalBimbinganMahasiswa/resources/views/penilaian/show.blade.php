@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Detail Penilaian Bimbingan</h5>
                    <a href="{{ route('penilaian.riwayat') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-2"></i>Kembali ke Riwayat
                    </a>
                </div>

                <div class="card-body">
                    <div class="mb-4">
                        <h6>Informasi Bimbingan</h6>
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Mahasiswa:</strong><br>
                                    {{ $jadwal->mahasiswa->nama }} ({{ $jadwal->mahasiswa->nim }})</p>
                                <p><strong>Dosen:</strong><br>
                                    {{ $jadwal->dosen->nama_dosen }}</p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Tanggal:</strong><br>
                                    {{ $jadwal->tanggal }}</p>
                                <p><strong>Waktu:</strong><br>
                                    {{ $jadwal->waktu_mulai }} - {{ $jadwal->waktu_selesai }}</p>
                            </div>
                        </div>
                        <p><strong>Topik:</strong><br>
                            {{ $jadwal->topik }}</p>
                    </div>

                    @if($jadwal->penilaianBimbingan)
                        <div class="mb-4">
                            <h6>Penilaian</h6>
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <div class="card bg-light">
                                        <div class="card-body text-center">
                                            <h6 class="card-title">Nilai Kehadiran</h6>
                                            <h2 class="mb-0">{{ $jadwal->penilaianBimbingan->nilai_kehadiran }}</h2>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card bg-light">
                                        <div class="card-body text-center">
                                            <h6 class="card-title">Nilai Kesiapan</h6>
                                            <h2 class="mb-0">{{ $jadwal->penilaianBimbingan->nilai_kesiapan }}</h2>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card bg-light">
                                        <div class="card-body text-center">
                                            <h6 class="card-title">Nilai Kemajuan</h6>
                                            <h2 class="mb-0">{{ $jadwal->penilaianBimbingan->nilai_kemajuan }}</h2>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <h6>Rata-rata Nilai</h6>
                                <div class="progress" style="height: 25px;">
                                    <div class="progress-bar bg-success" 
                                        role="progressbar" 
                                        style="width: {{ ($jadwal->penilaianBimbingan->rata_rata_nilai / 5) * 100 }}%">
                                        {{ number_format($jadwal->penilaianBimbingan->rata_rata_nilai, 1) }}
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <h6>Catatan Bimbingan</h6>
                                <div class="card">
                                    <div class="card-body">
                                        {{ $jadwal->penilaianBimbingan->catatan_bimbingan }}
                                    </div>
                                </div>
                            </div>

                            @if($jadwal->penilaianBimbingan->feedback)
                                <div class="mb-3">
                                    <h6>Feedback</h6>
                                    <div class="card">
                                        <div class="card-body">
                                            {{ $jadwal->penilaianBimbingan->feedback }}
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if($jadwal->penilaianBimbingan->rencana_tindak_lanjut)
                                <div class="mb-3">
                                    <h6>Rencana Tindak Lanjut</h6>
                                    <div class="card">
                                        <div class="card-body">
                                            {{ $jadwal->penilaianBimbingan->rencana_tindak_lanjut }}
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    @else
                        <div class="alert alert-info">
                            Belum ada penilaian untuk bimbingan ini.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 