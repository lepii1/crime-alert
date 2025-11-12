<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        User::create([
            'name' => 'Lepi',
            'email' => 'lepi@gmail.com',
            'password' => Hash::make('majumapan'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Imam',
            'email' => 'imam@gmail.com',
            'password' => Hash::make('imam123'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Liza',
            'email' => 'liza@gmail.com',
            'password' => Hash::make('liza123'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Linda',
            'email' => 'linda@gmail.com',
            'password' => Hash::make('linda123'),
            'role' => 'admin',
        ]);
    }
}
