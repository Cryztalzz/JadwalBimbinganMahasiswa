<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;

    protected $table = 'mahasiswa';
    protected $primaryKey = 'nim';
    public $timestamps = false;

    protected $fillable = [
        'nim',
        'nama',
        'email',
        'password',
        'notelp',
        'jurusan',
        'angkatan'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'email', 'email');
    }

    public function jadwalBimbingan()
    {
        return $this->hasMany(JadwalBimbingan::class, 'nim', 'nim');
    }
}