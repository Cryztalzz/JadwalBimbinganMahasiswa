
# 🗓️ JadwalBimbinganMahasiswa

Aplikasi berbasis web untuk mengatur dan mengelola **jadwal bimbingan mahasiswa** antara dosen dan mahasiswa secara terstruktur dan efisien. Dibuat sebagai solusi digital untuk memudahkan pengaturan jadwal dan dokumentasi proses bimbingan.

---

# 🎓 Anggota Kelompok

<div align="center">

| Nama | NIM |
|------|-----|
| Gregorius Alfa Putra   | 235314015 |
| Yudha Pramudya         | 235314021 |
| Rafael Mahesa Sakti    | 235314033 |
| Bradley aditya pasewang| 235314034 |

</div>

---

## 🚀 Fitur Utama

- ✅ Autentikasi pengguna (admin, dosen, mahasiswa)
- 📅 Tambah, ubah, dan hapus jadwal bimbingan
- 📊 Dashboard untuk melihat daftar bimbingan aktif dan riwayat
- 📝 Formulir pengajuan bimbingan oleh mahasiswa
- 🗂️ Manajemen data pengguna dan jadwal oleh admin

---

## ⚙️ Teknologi yang Digunakan

- **Framework**: Laravel (PHP)
- **Database**: MySQL
- **Frontend**: Blade templating (bawaan Laravel), Bootstrap

---

## 🧩 Instalasi

> Pastikan PHP, Composer, dan MySQL sudah terinstal sebelum memulai.

1. Clone repo:
   ```bash
   git clone https://github.com/Cryztalzz/JadwalBimbinganMahasiswa.git
   cd JadwalBimbinganMahasiswa
   ```

2. Install dependensi:
   ```bash
   composer install
   ```

3. Copy file `.env` dan konfigurasi:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. Buat database di MySQL, lalu atur `.env`:
   ```env
   DB_DATABASE=jadwal_bimbingan
   DB_USERNAME=root
   DB_PASSWORD=
   ```

5. Jalankan migrasi dan seeder:
   ```bash
   php artisan migrate --seed
   ```

6. Jalankan aplikasi:
   ```bash
   php artisan serve
   ```

Aplikasi akan berjalan di `http://127.0.0.1:8000` atau `http://localhost:8000`

---

## 📂 Struktur Direktori (Umum)

```
app/
├── Http/
│   ├── Controllers/
│   └── Middleware/
├── Models/
routes/
├── web.php
resources/
├── views/
├── js/
├── css/
```

---

## 🖼️ Tampilan (Optional)

![Welcome Page](/public/images/welcome.png)<br>
![Login Page](/public/images/login.png)<br>
![Admin Dashboard](/public/images/panel_admin.png)<br>
![Dosen Dashboard](/public/images/panel_dosen.png)<br>
![Mahasiswa Dashboard](/public/images/panel_mahasiswa.png)<br>

---
