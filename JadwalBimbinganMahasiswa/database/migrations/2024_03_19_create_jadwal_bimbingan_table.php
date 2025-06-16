<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('jadwal_bimbingan', function (Blueprint $table) {
            $table->id('id_jadwal');
            $table->foreignId('id_dosen')->constrained('dosen', 'id_dosen')->onDelete('cascade');
            $table->string('nim');
            $table->foreign('nim')->references('nim')->on('mahasiswa')->onDelete('cascade');
            $table->date('tanggal');
            $table->time('waktu_mulai');
            $table->time('waktu_selesai');
            $table->string('topik')->nullable();
            $table->enum('status', ['tersedia', 'dipesan', 'selesai'])->default('tersedia');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_bimbingan');
    }
}; 