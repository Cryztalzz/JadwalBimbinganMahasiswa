<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenilaianBimbingan extends Model
{
    use HasFactory;

    protected $table = 'penilaian_bimbingan';
    protected $primaryKey = 'id_penilaian';

    protected $fillable = [
        'id_jadwal',
        'catatan_bimbingan',
        'nilai_kehadiran',
        'nilai_kesiapan',
        'nilai_kemajuan',
        'feedback',
        'rencana_tindak_lanjut'
    ];

    public function jadwalBimbingan()
    {
        return $this->belongsTo(JadwalBimbingan::class, 'id_jadwal', 'id_jadwal');
    }

    public function getRataRataNilaiAttribute()
    {
        return ($this->nilai_kehadiran + $this->nilai_kesiapan + $this->nilai_kemajuan) / 3;
    }
} 