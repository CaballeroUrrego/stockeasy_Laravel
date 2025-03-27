<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'cedula' => '123456789',
            'id_rol' => 1, // ID del rol administrador
        ]);

        User::create([
            'name' => 'Vendedor User',
            'email' => 'vendedor@example.com',
            'password' => Hash::make('password'),
            'cedula' => '987654321',
            'id_rol' => 2, // ID del rol vendedor
        ]);
    }
}
