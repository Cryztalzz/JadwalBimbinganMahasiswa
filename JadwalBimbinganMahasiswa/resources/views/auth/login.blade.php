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
                                <i class="fas fa-user me-2"></i>Username / NIP / NIM
                            </label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0">
                                    <i class="fas fa-user text-primary"></i>
                                </span>
                                <input id="login" type="text" 
                                    class="form-control form-control-lg border-start-0 @error('login') is-invalid @enderror" 
                                    name="login" value="{{ old('login') }}" 
                                    required autocomplete="login" autofocus
                                    placeholder="Masukkan Username / NIP / NIM">
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
                                    class="form-control form-control-lg border-start-0 border-end-0 @error('password') is-invalid @enderror" 
                                    name="password" required autocomplete="current-password"
                                    placeholder="Masukkan password Anda">
                                <button class="btn btn-light border-start-0" type="button" id="togglePassword">
                                    <i class="fas fa-eye text-primary"></i>
                                </button>
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

<style>
    body {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        min-height: 100vh;
    }
    .card {
        border-radius: 20px;
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        box-shadow: 0 15px 35px rgba(0,0,0,0.2);
    }
    .logo-container {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        width: 100px;
        height: 100px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto;
    }
    .logo-container i {
        color: white !important;
    }
    .form-control {
        border-radius: 10px;
        padding: 12px 20px;
        border: 1px solid #e0e0e0;
        transition: all 0.3s ease;
    }
    .form-control:focus {
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        border-color: #667eea;
    }
    .input-group-text {
        border-radius: 10px 0 0 10px;
        border: 1px solid #e0e0e0;
    }
    .input-group .form-control {
        border-radius: 0;
    }
    .btn-primary {
        background: linear-gradient(90deg, #667eea 0%, #764ba2 100%);
        border: none;
        border-radius: 10px;
        padding: 12px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
        transition: all 0.3s ease;
    }
    .btn-primary:hover {
        background: linear-gradient(90deg, #764ba2 0%, #667eea 100%);
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.3);
    }
    .text-primary {
        color: #667eea !important;
    }
</style>

<script>
    document.getElementById('togglePassword').addEventListener('click', function() {
        const passwordInput = document.getElementById('password');
        const icon = this.querySelector('i');
        
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    });
</script>
@endsection 