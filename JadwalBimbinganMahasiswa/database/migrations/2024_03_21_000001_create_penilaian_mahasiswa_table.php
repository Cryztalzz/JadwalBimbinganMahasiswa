<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('penilaian_mahasiswa', function (Blueprint $table) {
            $table->id('id_penilaian');
            $table->foreignId('id_jadwal')->constrained('jadwal_bimbingan', 'id_jadwal')->onDelete('cascade');
            $table->string('kualitas_bimbingan');
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('penilaian_mahasiswa');
    }
}; 