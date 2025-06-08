<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PermintaanBimbingan extends Model
{
    protected $table = 'permintaan_bimbingan';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'id_mahasiswa',
        'id_dosen',
        'tanggal_permintaan',
        'topik',
        'deskripsi',
        'status'
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'id_mahasiswa');
    }

    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'id_dosen');
    }
} 