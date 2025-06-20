<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Ubah tipe data kolom status menjadi enum baru
        Schema::table('jadwal_bimbingan', function (Blueprint $table) {
            $table->enum('status', ['menunggu_persetujuan', 'disetujui', 'ditolak', 'dibatalkan', 'selesai'])->default('menunggu_persetujuan')->change();
        });

        // Update nilai status yang ada
        DB::table('jadwal_bimbingan')
            ->where('status', 'tersedia')
            ->update(['status' => 'menunggu_persetujuan']);

        DB::table('jadwal_bimbingan')
            ->where('status', 'dipesan')
            ->update(['status' => 'menunggu_persetujuan']);

        DB::table('jadwal_bimbingan')
            ->where('status', 'selesai')
            ->update(['status' => 'selesai']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Kembalikan tipe data kolom status ke string (atau enum lama jika perlu)
        Schema::table('jadwal_bimbingan', function (Blueprint $table) {
            $table->string('status', 20)->change();
        });

        // Kembalikan nilai status ke nilai sebelumnya
        DB::table('jadwal_bimbingan')
            ->where('status', 'menunggu_persetujuan')
            ->update(['status' => 'tersedia']);

        DB::table('jadwal_bimbingan')
            ->where('status', 'selesai')
            ->update(['status' => 'selesai']);
    }
}; 