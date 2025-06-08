<?php

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}

require __DIR__.'/../vendor/autoload.php';

/** @var Application $app */
$app = require_once __DIR__.'/../bootstrap/app.php';

$app->handleRequest(Request::capture());

session_start();

$user = [
    'name' => 'John Doe',
    'image' => 'https://via.placeholder.com/40'
];

$jadwal_bimbingan = [
    [
        'id' => 1,
        'nama_mahasiswa' => 'John Doe',
        'dosen' => 'Dr. Jane Smith',
        'tanggal' => '2024-03-20',
        'waktu' => '09:00',
        'status' => 'Diterima'
    ],
    [
        'id' => 2,
        'nama_mahasiswa' => 'Jane Doe',
        'dosen' => 'Dr. John Smith',
        'tanggal' => '2024-03-21',
        'waktu' => '10:00',
        'status' => 'Menunggu'
    ]
];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jadwal Bimbingan Mahasiswa</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <nav class="navbar">
        <div class="hamburger">
            <div class="hamburger-icon">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
        <div class="nav-links">
            <a href="#" class="nav-link">Beranda</a>
            <a href="#" class="nav-link">Jadwal</a>
            <a href="#" class="nav-link">Bantuan</a>
        </div>
        <div class="profile">
            <img src="<?php echo htmlspecialchars($user['image']); ?>" alt="Profile" class="profile-img">
            <span class="profile-name"><?php echo htmlspecialchars($user['name']); ?></span>
        </div>
    </nav>

    <div class="sidebar">
        <div class="sidebar-links">
            <a href="#" class="sidebar-link">Beranda</a>
            <a href="#" class="sidebar-link">Jadwal</a>
            <a href="#" class="sidebar-link">Bantuan</a>
        </div>
    </div>

    <main class="content">
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Mahasiswa</th>
                        <th>Dosen Pembimbing</th>
                        <th>Tanggal</th>
                        <th>Waktu</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($jadwal_bimbingan as $jadwal): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($jadwal['id']); ?></td>
                        <td><?php echo htmlspecialchars($jadwal['nama_mahasiswa']); ?></td>
                        <td><?php echo htmlspecialchars($jadwal['dosen']); ?></td>
                        <td><?php echo htmlspecialchars($jadwal['tanggal']); ?></td>
                        <td><?php echo htmlspecialchars($jadwal['waktu']); ?></td>
                        <td><?php echo htmlspecialchars($jadwal['status']); ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </main>

    <script src="js/script.js"></script>
</body>
</html>