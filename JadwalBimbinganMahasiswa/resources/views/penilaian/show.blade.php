@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Detail Penilaian Bimbingan</h5>
                    <a href="{{ route('jadwal-bimbingan.index') }}" class="btn btn-secondary">Kembali</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                                <th style="width: 200px">Tanggal Bimbingan</th>
                                <td>{{ $jadwal->tanggal ? \Carbon\Carbon::parse($jadwal->tanggal)->format('d/m/Y') : '-' }}</td>
                            </tr>
                            <tr>
                                <th>Waktu</th>
                                <td>{{ $jadwal->waktu_mulai ? \Carbon\Carbon::parse($jadwal->waktu_mulai)->format('H:i') : '-' }} - {{ $jadwal->waktu_selesai ? \Carbon\Carbon::parse($jadwal->waktu_selesai)->format('H:i') : '-' }} WIB</td>
                            </tr>
                            <tr>
                                <th>Nama Mahasiswa</th>
                                <td>{{ $jadwal->mahasiswa->nama ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>NIM</th>
                                <td>{{ $jadwal->mahasiswa->nim ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>Program Studi</th>
                                <td>{{ $jadwal->mahasiswa->jurusan ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>Topik Bimbingan</th>
                                <td>{{ $jadwal->topik ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>Aktivitas Mahasiswa</th>
                                <td>
                                    @if($jadwal->penilaianBimbingan)
                                        @if($jadwal->penilaianBimbingan->aktivitas_mahasiswa == 'Aktif')
                                            <span class="badge bg-success">Aktif</span>
                                        @elseif($jadwal->penilaianBimbingan->aktivitas_mahasiswa == 'Cukup Aktif')
                                            <span class="badge bg-info">Cukup Aktif</span>
                                        @else
                                            <span class="badge bg-warning">Kurang Aktif</span>
                                        @endif
                                    @else
                                        -
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Keterangan</th>
                                <td>{{ $jadwal->penilaianBimbingan->keterangan ?? '-' }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 