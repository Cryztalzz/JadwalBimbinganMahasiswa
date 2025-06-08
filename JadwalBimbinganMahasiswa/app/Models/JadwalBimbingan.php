<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JadwalBimbingan extends Model
{
    protected $table = 'jadwal_bimbingan';
    protected $primaryKey = 'id_jadwal';
    public $timestamps = false;

    protected $fillable = [
        'id_dosen',
        'id_mahasiswa',
        'tanggal',
        'waktu_mulai',
        'waktu_selesai',
        'status'
    ];

    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'id_dosen');
    }

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'id_mahasiswa');
    }

    public function penilaianBimbingan()
    {
        return $this->hasOne(PenilaianBimbingan::class, 'id_jadwal');
    }
} 