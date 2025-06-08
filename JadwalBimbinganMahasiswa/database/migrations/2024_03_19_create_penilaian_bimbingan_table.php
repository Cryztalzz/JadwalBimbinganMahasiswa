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
        Schema::create('penilaian_bimbingan', function (Blueprint $table) {
            $table->id('id_penilaian');
            $table->string('nim');
            $table->foreignId('id_dosen')->constrained('dosen', 'id_dosen')->onDelete('cascade');
            $table->string('nama_dosen');
            $table->decimal('nilai', 5, 2);
            $table->text('catatan');
            $table->date('tanggal_nilai');
            $table->timestamps();

            $table->foreign('nim')->references('nim')->on('mahasiswa')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penilaian_bimbingan');
    }
}; 