<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Buat user admin
        User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin'
        ]);

        // Buat user dosen
        User::create([
            'name' => 'Dosen',
            'email' => 'dosen@dosen.com',
            'password' => Hash::make('dosen123'),
            'role' => 'dosen'
        ]);

        // Buat user mahasiswa
        User::create([
            'name' => 'Mahasiswa',
            'email' => 'mahasiswa@mahasiswa.com',
            'password' => Hash::make('mahasiswa123'),
            'role' => 'mahasiswa'
        ]);
    }
} 