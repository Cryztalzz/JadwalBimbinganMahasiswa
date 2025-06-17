@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Detail Penilaian Bimbingan</h4>
            <div>
                <a href="{{ url()->previous() }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <table class="table">
                        <tr>
                            <th width="200">Tanggal</th>
                            <td>{{ \Carbon\Carbon::parse($jadwal->tanggal)->format('d/m/Y') }}</td>
                        </tr>
                        <tr>
                            <th>Waktu</th>
                            <td>{{ \Carbon\Carbon::parse($jadwal->waktu_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($jadwal->waktu_selesai)->format('H:i') }}</td>
                        </tr>
                        <tr>
                            <th>Dosen</th>
                            <td>{{ $jadwal->dosen->nama_dosen }} ({{ $jadwal->dosen->nip }})</td>
                        </tr>
                        <tr>
                            <th>Topik</th>
                            <td>{{ $jadwal->topik }}</td>
                        </tr>
                        <tr>
                            <th>Kualitas Bimbingan</th>
                            <td>
                                @if($jadwal->penilaianMahasiswa->kualitas_bimbingan == 'Sangat Baik')
                                    <span class="badge bg-success">Sangat Baik</span>
                                @elseif($jadwal->penilaianMahasiswa->kualitas_bimbingan == 'Baik')
                                    <span class="badge bg-info">Baik</span>
                                @elseif($jadwal->penilaianMahasiswa->kualitas_bimbingan == 'Cukup')
                                    <span class="badge bg-warning">Cukup</span>
                                @elseif($jadwal->penilaianMahasiswa->kualitas_bimbingan == 'Kurang')
                                    <span class="badge bg-danger">Kurang</span>
                                @else
                                    <span class="badge bg-danger">Sangat Kurang</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Keterangan</th>
                            <td>{{ $jadwal->penilaianMahasiswa->keterangan }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 