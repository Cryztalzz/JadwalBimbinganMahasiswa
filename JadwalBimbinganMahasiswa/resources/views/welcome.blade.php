@extends('layouts.app')

@section('content')
<div class="welcome-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="welcome-card">
                    <i class="fas fa-graduation-cap feature-icon"></i>
                    <h1 class="welcome-title">Selamat Datang di Sistem Jadwal Bimbingan</h1>
                    <p class="welcome-text">Platform modern untuk mengelola jadwal bimbingan antara mahasiswa dan dosen dengan mudah dan efisien.</p>
                    
                    <div class="text-center mt-5">
                        <a href="{{ route('login') }}" class="btn btn-primary btn-lg">
                            <i class="fas fa-sign-in-alt me-2"></i>Login
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .welcome-section {
        padding: 100px 0;
    }
    .welcome-card {
        background: rgba(255, 255, 255, 0.95);
        border-radius: 20px;
        padding: 50px;
        text-align: center;
        box-shadow: 0 15px 35px rgba(0,0,0,0.2);
        backdrop-filter: blur(10px);
    }
    .feature-icon {
        font-size: 4rem;
        color: #667eea;
        margin-bottom: 30px;
    }
    .welcome-title {
        font-size: 2.5rem;
        font-weight: 700;
        color: #2d3436;
        margin-bottom: 20px;
    }
    .welcome-text {
        font-size: 1.2rem;
        color: #636e72;
        margin-bottom: 30px;
    }
    .btn-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        border-radius: 10px;
        padding: 15px 40px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
        transition: all 0.3s ease;
    }
    .btn-primary:hover {
        background: linear-gradient(135deg, #764ba2 0%, #667eea 100%);
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.3);
    }
    @media (max-width: 768px) {
        .welcome-section {
            padding: 50px 0;
        }
        .welcome-card {
            padding: 30px;
        }
        .welcome-title {
            font-size: 2rem;
        }
        .welcome-text {
            font-size: 1.1rem;
        }
    }
</style>
@endsection
