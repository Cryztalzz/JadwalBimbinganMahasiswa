@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">
                        <i class="fas fa-user-tie me-2"></i>
                        Kelola Dosen
                    </h5>
                    <div>
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary btn-custom btn-sm me-2">
                            <i class="fas fa-arrow-left me-1"></i> Kembali
                        </a>
                        <a href="{{ route('admin.dosen.create') }}" class="btn btn-primary btn-custom btn-sm">
                            <i class="fas fa-plus me-1"></i> Tambah Dosen
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
                        <table class="table table-bordered table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>NIP</th>
                                    <th>No. Telepon</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($dosen as $key => $d)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $d->nama_dosen }}</td>
                                    <td>{{ $d->email }}</td>
                                    <td>{{ $d->nip }}</td>
                                    <td>{{ $d->notelp }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.dosen.edit', $d->id_dosen) }}" class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit me-1"></i> Edit
                                        </a>
                                        <form action="{{ route('admin.dosen.destroy', $d->id_dosen) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus dosen ini?')">
                                                <i class="fas fa-trash me-1"></i> Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center">Tidak ada data dosen</td>
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