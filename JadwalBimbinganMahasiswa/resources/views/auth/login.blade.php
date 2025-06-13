@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center align-items-center min-vh-100">
        <div class="col-md-6">
            <div class="card shadow-lg border-0">
                <div class="card-body p-5">
                    <div class="text-center mb-4">
                        <div class="logo-container mb-4">
                            <i class="fas fa-graduation-cap fa-4x text-primary"></i>
                        </div>
                        <h2 class="fw-bold text-primary">Selamat Datang</h2>
                        <p class="text-muted">Silakan login untuk mengakses sistem bimbingan</p>
                    </div>

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        @if ($errors->has('login'))
                            <div class="alert alert-danger">
                                <i class="fas fa-exclamation-triangle me-2"></i>
                                {{ $errors->first('login') }}
                            </div>
                        @endif

                        <div class="mb-4">
                            <label for="login" class="form-label text-muted">
                                <i class="fas fa-user me-2"></i>Username
                            </label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0">
                                    <i class="fas fa-user text-primary"></i>
                                </span>
                                <input id="login" type="text" 
                                    class="form-control form-control-lg border-start-0 @error('login') is-invalid @enderror" 
                                    name="login" value="{{ old('login') }}" 
                                    required autocomplete="login" autofocus
                                    placeholder="Masukkan username">
                            </div>
                            @error('login')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="password" class="form-label text-muted">
                                <i class="fas fa-lock me-2"></i>Password
                            </label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0">
                                    <i class="fas fa-lock text-primary"></i>
                                </span>
                                <input id="password" type="password" 
                                    class="form-control form-control-lg border-start-0 @error('password') is-invalid @enderror" 
                                    name="password" 
                                    required autocomplete="current-password"
                                    placeholder="Masukkan password">
                            </div>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="fas fa-sign-in-alt me-2"></i>Login
                            </button>
                        </div>
                    </form>

                    <div class="text-center mt-4">
                        <a href="/" class="text-decoration-none text-primary">
                            <i class="fas fa-arrow-left me-1"></i>Kembali ke Beranda
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 