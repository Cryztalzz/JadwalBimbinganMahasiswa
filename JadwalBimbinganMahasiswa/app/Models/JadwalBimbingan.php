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
        'status'
    ];

    protected $casts = [
        'tanggal' => 'date',
        'waktu_mulai' => 'datetime',
        'waktu_selesai' => 'datetime',
    ];

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
        return $this->hasOne(PenilaianBimbingan::class, 'id_jadwal');
    }
} 