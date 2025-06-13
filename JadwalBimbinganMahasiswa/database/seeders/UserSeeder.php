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
            'username' => 'admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin'
        ]);

        // Buat user dosen
        User::create([
            'name' => 'Dosen',
            'username' => 'dosen',
            'email' => 'dosen@dosen.com',
            'password' => Hash::make('dosen123'),
            'role' => 'dosen'
        ]);

        // Buat user mahasiswa
        User::create([
            'name' => 'Mahasiswa',
            'username' => 'mahasiswa',
            'email' => 'mahasiswa@mahasiswa.com',
            'password' => Hash::make('mahasiswa123'),
            'role' => 'mahasiswa'
        ]);
    }
} 