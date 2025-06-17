<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('penilaian_bimbingan', function (Blueprint $table) {
            $table->id('id_penilaian');
            $table->foreignId('id_jadwal')->constrained('jadwal_bimbingan', 'id_jadwal')->onDelete('cascade');
            $table->text('catatan_bimbingan');
            $table->integer('nilai_kehadiran')->comment('1-5');
            $table->integer('nilai_kesiapan')->comment('1-5');
            $table->integer('nilai_kemajuan')->comment('1-5');
            $table->text('feedback')->nullable();
            $table->text('rencana_tindak_lanjut')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('penilaian_bimbingan');
    }
}; 