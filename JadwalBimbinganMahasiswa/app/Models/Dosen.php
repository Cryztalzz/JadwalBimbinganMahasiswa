<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    protected $table = 'dosen';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'nip',
        'nama',
        'bidang_keahlian',
        'email'
    ];

    public function jadwalBimbingan()
    {
        return $this->hasMany(JadwalBimbingan::class, 'id_dosen');
    }

    public function permintaanBimbingan()
    {
        return $this->hasMany(PermintaanBimbingan::class, 'id_dosen');
    }
} 