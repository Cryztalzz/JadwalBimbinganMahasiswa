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
        Schema::create('permintaan_bimbingan', function (Blueprint $table) {
            $table->id('id_permintaan');
            $table->string('nim');
            $table->foreignId('id_jadwal')->constrained('jadwal_bimbingan', 'id_jadwal')->onDelete('cascade');
            $table->date('tanggal_request');
            $table->timestamps();

            $table->foreign('nim')->references('nim')->on('mahasiswa')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permintaan_bimbingan');
    }
}; 