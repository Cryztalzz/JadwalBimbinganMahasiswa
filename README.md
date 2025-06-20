# 🗓️ JadwalBimbinganMahasiswa

[![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://php.net)
[![MySQL](https://img.shields.io/badge/MySQL-00000F?style=for-the-badge&logo=mysql&logoColor=white)](https://mysql.com)
[![Bootstrap](https://img.shields.io/badge/Bootstrap-563D7C?style=for-the-badge&logo=bootstrap&logoColor=white)](https://getbootstrap.com)

<div align="center">

![Banner](JadwalBimbinganMahasiswa/public/images/welcome.png)

Aplikasi berbasis web untuk mengatur dan mengelola **jadwal bimbingan mahasiswa** antara dosen dan mahasiswa secara terstruktur dan efisien. Dibuat sebagai solusi digital untuk memudahkan pengaturan jadwal dan dokumentasi proses bimbingan.

[![Stars](https://img.shields.io/github/stars/Cryztalzz/JadwalBimbinganMahasiswa?style=social)](https://github.com/Cryztalzz/JadwalBimbinganMahasiswa/stargazers)
[![Forks](https://img.shields.io/github/forks/Cryztalzz/JadwalBimbinganMahasiswa?style=social)](https://github.com/Cryztalzz/JadwalBimbinganMahasiswa/network/members)

</div>

---

## 👥 Anggota Kelompok

<div align="center">

| Nama | NIM |
|------|-----|
| Gregorius Alfa Putra   | 235314015 |
| Yudha Pramudya         | 235314021 |
| Rafael Mahesa Sakti    | 235314033 |
| Bradley aditya pasewang| 235314034 |

</div>

---

## ✨ Fitur Utama

<div align="center">

| Fitur | Deskripsi |
|-------|-----------|
| 🔐 Autentikasi | Sistem login untuk admin, dosen, dan mahasiswa |
| 📅 Manajemen Jadwal | Tambah, ubah, dan hapus jadwal bimbingan |
| 📊 Dashboard | Melihat daftar bimbingan aktif dan riwayat |
| 📝 Pengajuan | Formulir pengajuan bimbingan oleh mahasiswa |
| 👥 Manajemen User | Pengelolaan data pengguna dan jadwal oleh admin |

</div>

---

## 🛠️ Teknologi yang Digunakan

<div align="center">

| Kategori | Teknologi |
|----------|-----------|
| Framework | Laravel (PHP) |
| Database | MySQL |
| Frontend | Blade templating, Bootstrap |
| Version Control | Git & GitHub |

</div>

---

## 🚀 Instalasi

> ⚠️ **Prasyarat**: Pastikan PHP, Composer, dan MySQL sudah terinstal sebelum memulai.

1. **Clone repository**
   ```bash
   git clone https://github.com/Cryztalzz/JadwalBimbinganMahasiswa.git
   cd JadwalBimbinganMahasiswa
   ```

2. **Install dependensi**
   ```bash
   composer install
   ```

3. **Konfigurasi environment**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Setup database**
   ```env
   DB_DATABASE=jadwal_bimbingan
   DB_USERNAME=root
   DB_PASSWORD=
   ```

5. **Jalankan migrasi dan seeder**
   ```bash
   php artisan migrate --seed
   ```

6. **Jalankan aplikasi**
   ```bash
   php artisan serve
   ```

> 🌐 Aplikasi akan berjalan di `http://127.0.0.1:8000` atau `http://localhost:8000`

---

## 📁 Struktur Direktori

```
app/
├── Http/
│   ├── Controllers/    # Controller untuk menangani request
│   └── Middleware/     # Middleware untuk autentikasi dan otorisasi
├── Models/             # Model untuk interaksi dengan database
routes/
├── web.php            # Definisi route aplikasi
resources/
├── views/             # Template Blade
├── js/                # File JavaScript
├── css/               # File CSS
```

---

## 🖼️ Screenshot Tampilan

<div align="center">

![Welcome Page](JadwalBimbinganMahasiswa/public/images/welcome.png)
*Welcome Page*

![Login Page](JadwalBimbinganMahasiswa/public/images/login.png)
*Login Page*

![Admin Dashboard](JadwalBimbinganMahasiswa/public/images/panel_admin.png)
*Admin Dashboard*

![Dosen Dashboard](JadwalBimbinganMahasiswa/public/images/panel_dosen.png)
*Dosen Dashboard*

![Mahasiswa Dashboard](JadwalBimbinganMahasiswa/public/images/panel_mahasiswa.png)
*Mahasiswa Dashboard*

</div>
