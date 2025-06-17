<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PenilaianMahasiswa extends Model
{
    protected $table = 'penilaian_mahasiswa';
    protected $primaryKey = 'id_penilaian';
    protected $fillable = [
        'id_jadwal',
        'kualitas_bimbingan',
        'keterangan'
    ];

    public function jadwalBimbingan()
    {
        return $this->belongsTo(JadwalBimbingan::class, 'id_jadwal', 'id_jadwal');
    }
} 