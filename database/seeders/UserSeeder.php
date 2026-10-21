<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Akun Admin
        User::firstOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Administrator Kampus',
                'password' => Hash::make('password123'),
                'role' => 'admin',
            ]
        );

        // 2. Akun Dosen
        User::firstOrCreate(
            ['email' => 'dosen@gmail.com'],
            [
                'name' => 'Bapak Dosen, M.Kom.',
                'password' => Hash::make('password123'),
                'role' => 'dosen',
            ]
        );

        // 3. Akun Mahasiswa
        User::firstOrCreate(
            ['email' => 'mhs@gmail.com'],
            [
                'name' => 'Fakhriza (Mahasiswa)',
                'password' => Hash::make('password123'),
                'role' => 'mhs',
            ]
        );
    }
}