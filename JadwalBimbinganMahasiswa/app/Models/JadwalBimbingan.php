<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalBimbingan extends Model
{
    use HasFactory;

    protected $table = 'jadwal_bimbingan';
    protected $primaryKey = 'id_jadwal';
    public $incrementing = true;
    protected $keyType = 'integer';

    protected $fillable = [
        'id_dosen',
        'nim',
        'tanggal',
        'waktu_mulai',
        'waktu_selesai',
        'topik',
        'status'
    ];

    protected $casts = [
        'tanggal' => 'date',
        'waktu_mulai' => 'datetime',
        'waktu_selesai' => 'datetime',
    ];

    // Konstanta untuk status
    const STATUS_MENUNGGU = 'menunggu_persetujuan';
    const STATUS_DISETUJUI = 'disetujui';
    const STATUS_DITOLAK = 'ditolak';
    const STATUS_DIBATALKAN = 'dibatalkan';
    const STATUS_SELESAI = 'selesai';

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'nim', 'nim');
    }

    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'id_dosen', 'id_dosen');
    }

    public function penilaianBimbingan()
    {
        return $this->hasOne(PenilaianBimbingan::class, 'id_jadwal', 'id_jadwal');
    }

    public function penilaianMahasiswa()
    {
        return $this->hasOne(PenilaianMahasiswa::class, 'id_jadwal', 'id_jadwal');
    }

    // Helper method untuk mengecek status
    public function isMenunggu()
    {
        return $this->status === self::STATUS_MENUNGGU;
    }

    public function isDisetujui()
    {
        return $this->status === self::STATUS_DISETUJUI;
    }

    public function isDitolak()
    {
        return $this->status === self::STATUS_DITOLAK;
    }

    public function isDibatalkan()
    {
        return $this->status === self::STATUS_DIBATALKAN;
    }

    public function isSelesai()
    {
        return $this->status === self::STATUS_SELESAI;
    }
} 