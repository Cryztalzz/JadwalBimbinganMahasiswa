<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PenilaianBimbingan extends Model
{
    protected $table = 'penilaian_bimbingan';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'id_jadwal',
        'nilai',
        'komentar',
        'tanggal_penilaian'
    ];

    public function jadwalBimbingan()
    {
        return $this->belongsTo(JadwalBimbingan::class, 'id_jadwal');
    }
} 