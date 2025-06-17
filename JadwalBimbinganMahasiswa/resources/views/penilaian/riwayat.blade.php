@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Riwayat Penilaian Bimbingan</h5>
                    <a href="{{ Auth::user()->hasRole('dosen') ? route('dosen.dashboard') : route('mahasiswa.dashboard') }}" 
                        class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-2"></i>Kembali ke Dashboard
                    </a>
                </div>

                <div class="card-body">
                    @if($penilaian->isEmpty())
                        <div class="alert alert-info">
                            Belum ada riwayat penilaian bimbingan.
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>{{ Auth::user()->hasRole('dosen') ? 'Mahasiswa' : 'Dosen' }}</th>
                                        <th>Topik</th>
                                        <th>Nilai Rata-rata</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($penilaian as $p)
                                        <tr>
                                            <td>{{ $p->jadwalBimbingan->tanggal }}</td>
                                            <td>
                                                @if(Auth::user()->hasRole('dosen'))
                                                    {{ $p->jadwalBimbingan->mahasiswa->nama }}
                                                    ({{ $p->jadwalBimbingan->mahasiswa->nim }})
                                                @else
                                                    {{ $p->jadwalBimbingan->dosen->nama_dosen }}
                                                @endif
                                            </td>
                                            <td>{{ $p->jadwalBimbingan->topik }}</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="progress flex-grow-1" style="height: 20px;">
                                                        <div class="progress-bar bg-success" 
                                                            role="progressbar" 
                                                            style="width: {{ ($p->rata_rata_nilai / 5) * 100 }}%">
                                                            {{ number_format($p->rata_rata_nilai, 1) }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="badge bg-success">Selesai</span>
                                            </td>
                                            <td>
                                                <a href="{{ route('penilaian.show', $p->jadwalBimbingan->id_jadwal) }}" 
                                                    class="btn btn-info btn-sm">
                                                    <i class="fas fa-eye"></i> Detail
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 