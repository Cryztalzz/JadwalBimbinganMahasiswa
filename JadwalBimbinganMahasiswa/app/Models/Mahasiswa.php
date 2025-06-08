<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $table = 'mahasiswa';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'nim',
        'nama',
        'jurusan',
        'angkatan'
    ];

    public function jadwalBimbingan()
    {
        return $this->hasMany(JadwalBimbingan::class, 'id_mahasiswa');
    }

    public function permintaanBimbingan()
    {
        return $this->hasMany(PermintaanBimbingan::class, 'id_mahasiswa');
    }
} 