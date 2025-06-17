@extends('layouts.app')

@section('content')
<div class="container py-5">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="card">
        <div class="card-header">
            <h4 class="mb-0">Kontak Support</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <h5>Informasi Kontak</h5>
                    <ul class="list-unstyled">
                        <li class="mb-3">
                            <i class="fas fa-envelope me-2"></i>
                            Email: support@rest-area.my.id
                        </li>
                        <li class="mb-3">
                            <i class="fas fa-phone me-2"></i>
                            Telepon: +62 812-1391-0775
                        </li>
                        <li class="mb-3">
                            <i class="fas fa-map-marker-alt me-2"></i>
                            Alamat: Jl. Gatau Mau Isi Apa No.712
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 