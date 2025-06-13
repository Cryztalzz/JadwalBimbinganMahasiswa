<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Jadwal Bimbingan Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #667eea;
            --secondary-color: #764ba2;
            --success-color: #00b894;
            --info-color: #0984e3;
        }

        body {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .navbar {
            background: rgba(255, 255, 255, 0.1) !important;
            backdrop-filter: blur(10px);
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            color: white !important;
        }

        .nav-link {
            color: rgba(255, 255, 255, 0.9) !important;
            font-weight: 500;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .nav-link:hover {
            background: rgba(255, 255, 255, 0.1);
            color: white !important;
        }

        .welcome-section {
            padding: 100px 0;
            text-align: center;
        }

        .welcome-card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
            padding: 50px;
            margin-top: 30px;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .welcome-title {
            color: var(--primary-color);
            font-size: 2.8rem;
            font-weight: 800;
            margin-bottom: 20px;
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .welcome-text {
            color: #546e7a;
            font-size: 1.3rem;
            margin-bottom: 40px;
            line-height: 1.6;
        }

        .feature-card {
            background: white;
            border-radius: 15px;
            padding: 30px;
            height: 100%;
            transition: all 0.3s ease;
            border: 1px solid rgba(0, 0, 0, 0.05);
        }

        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .feature-icon {
            font-size: 3rem;
            margin-bottom: 25px;
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .feature-title {
            color: var(--primary-color);
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 15px;
        }

        .feature-text {
            color: #666;
            font-size: 1.1rem;
            margin-bottom: 25px;
            line-height: 1.5;
        }

        .btn-custom {
            padding: 12px 30px;
            border-radius: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s ease;
            width: 100%;
            border: none;
        }

        .btn-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
        }

        .btn-success {
            background: linear-gradient(135deg, var(--success-color) 0%, #00cec9 100%);
        }

        .btn-info {
            background: linear-gradient(135deg, var(--info-color) 0%, #74b9ff 100%);
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
</head>
<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="/">
                <i class="fas fa-graduation-cap me-2"></i>
                Jadwal Bimbingan
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">
                            <i class="fas fa-sign-in-alt me-2"></i>
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
                        
                        <div class="row mt-5 g-4">
                            <div class="col-md-4">
                                <div class="feature-card">
                                    <i class="fas fa-users feature-icon"></i>
                                    <h3 class="feature-title">Mahasiswa</h3>
                                    <p class="feature-text">Kelola jadwal bimbingan Anda dengan dosen pembimbing secara efisien</p>
                                    <a href="{{ route('mahasiswa.index') }}" class="btn btn-primary btn-custom">
                                        <i class="fas fa-arrow-right me-2"></i>Lihat Mahasiswa
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="feature-card">
                                    <i class="fas fa-chalkboard-teacher feature-icon"></i>
                                    <h3 class="feature-title">Dosen</h3>
                                    <p class="feature-text">Atur jadwal bimbingan dengan mahasiswa bimbingan Anda dengan mudah</p>
                                    <a href="{{ route('dosen.index') }}" class="btn btn-success btn-custom">
                                        <i class="fas fa-arrow-right me-2"></i>Lihat Dosen
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="feature-card">
                                    <i class="fas fa-calendar-alt feature-icon"></i>
                                    <h3 class="feature-title">Jadwal</h3>
                                    <p class="feature-text">Lihat dan kelola jadwal bimbingan yang telah diatur secara terstruktur</p>
                                    <a href="{{ route('jadwal.index') }}" class="btn btn-info btn-custom">
                                        <i class="fas fa-arrow-right me-2"></i>Lihat Jadwal
                                    </a>
                                </div>
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
