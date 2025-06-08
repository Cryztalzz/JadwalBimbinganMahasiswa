<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Jadwal Bimbingan Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
        }
        .navbar {
            background: linear-gradient(90deg, #1a237e 0%, #283593 100%) !important;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .welcome-section {
            padding: 80px 0;
            text-align: center;
        }
        .welcome-card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
            padding: 40px;
            margin-top: 30px;
        }
        .welcome-title {
            color: #1a237e;
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 20px;
        }
        .welcome-text {
            color: #546e7a;
            font-size: 1.2rem;
            margin-bottom: 30px;
        }
        .feature-icon {
            font-size: 2.5rem;
            color: #1a237e;
            margin-bottom: 20px;
        }
        .btn-custom {
            padding: 12px 30px;
            border-radius: 30px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s ease;
        }
        .btn-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }
        .btn-primary {
            background: linear-gradient(90deg, #1a237e 0%, #283593 100%);
            border: none;
        }
        .btn-success {
            background: linear-gradient(90deg, #2e7d32 0%, #388e3c 100%);
            border: none;
        }
        .btn-info {
            background: linear-gradient(90deg, #0277bd 0%, #0288d1 100%);
            border: none;
            color: white;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="/">
                <i class="fas fa-calendar-check me-2"></i>
                Jadwal Bimbingan
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">
                            <i class="fas fa-sign-in-alt me-1"></i>
                            Login
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="welcome-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="welcome-card">
                        <i class="fas fa-graduation-cap feature-icon"></i>
                        <h1 class="welcome-title">Selamat Datang di Sistem Jadwal Bimbingan</h1>
                        <p class="welcome-text">Platform modern untuk mengelola jadwal bimbingan antara mahasiswa dan dosen dengan mudah dan efisien.</p>
                        
                        <div class="row mt-5">
                            <div class="col-md-4">
                                <i class="fas fa-users feature-icon"></i>
                                <h3>Mahasiswa</h3>
                                <p>Kelola jadwal bimbingan Anda dengan dosen pembimbing</p>
                                <a href="{{ route('mahasiswa.index') }}" class="btn btn-primary btn-custom w-100">Lihat Mahasiswa</a>
                            </div>
                            <div class="col-md-4">
                                <i class="fas fa-chalkboard-teacher feature-icon"></i>
                                <h3>Dosen</h3>
                                <p>Atur jadwal bimbingan dengan mahasiswa bimbingan Anda</p>
                                <a href="{{ route('dosen.index') }}" class="btn btn-success btn-custom w-100">Lihat Dosen</a>
                            </div>
                            <div class="col-md-4">
                                <i class="fas fa-calendar-alt feature-icon"></i>
                                <h3>Jadwal</h3>
                                <p>Lihat dan kelola jadwal bimbingan yang telah diatur</p>
                                <a href="{{ route('jadwal.index') }}" class="btn btn-info btn-custom w-100">Lihat Jadwal</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
