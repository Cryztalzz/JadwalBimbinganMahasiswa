<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    use HasFactory;

    protected $table = 'dosen';
    protected $primaryKey = 'id_dosen';
    public $timestamps = false;

    protected $fillable = [
        'id_dosen',
        'nama_dosen',
        'email',
        'nip',
        'password',
        'notelp'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'email', 'email');
    }

    public function jadwalBimbingan()
    {
        return $this->hasMany(JadwalBimbingan::class, 'id_dosen', 'id_dosen');
    }
}