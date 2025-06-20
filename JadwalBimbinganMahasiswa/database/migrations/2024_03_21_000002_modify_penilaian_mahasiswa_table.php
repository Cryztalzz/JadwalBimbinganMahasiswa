<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        DB::table('penilaian_mahasiswa')->whereNull('keterangan')->update(['keterangan' => '']);
        Schema::table('penilaian_mahasiswa', function (Blueprint $table) {
            $table->text('keterangan')->nullable()->change();
        });
    }

    public function down()
    {
        DB::table('penilaian_mahasiswa')->whereNull('keterangan')->update(['keterangan' => '']);
        Schema::table('penilaian_mahasiswa', function (Blueprint $table) {
            $table->text('keterangan')->nullable(false)->change();
        });
    }
}; 