@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="card">
        <div class="card-header">
            <h4 class="mb-0">Buat Jadwal Bimbingan Baru</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('jadwal-bimbingan.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="dosen_id" class="form-label">Dosen Pembimbing</label>
                    <select class="form-select" id="dosen_id" name="dosen_id" required>
                        <option value="">Pilih Dosen</option>
                        @foreach($dosen as $d)
                            <option value="{{ $d->id }}">{{ $d->nama }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="tanggal" class="form-label">Tanggal</label>
                    <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="waktu_mulai" class="form-label">Waktu Mulai</label>
                            <input type="time" class="form-control" id="waktu_mulai" name="waktu_mulai" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="waktu_selesai" class="form-label">Waktu Selesai</label>
                            <input type="time" class="form-control" id="waktu_selesai" name="waktu_selesai" required>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="topik" class="form-label">Topik Bimbingan</label>
                    <textarea class="form-control" id="topik" name="topik" rows="3" required></textarea>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('jadwal-bimbingan.index') }}" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-primary">Buat Jadwal</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection 