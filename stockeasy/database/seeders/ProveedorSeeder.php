<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProveedorSeeder extends Seeder
{
    public function run()
    {
        DB::table('proveedores')->insert([
            [
                'nombre' => 'Tech Distribuidora',
                'nit' => '900123456-7',
                'telefono' => '3012345678',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'ElectroShop S.A.',
                'nit' => '901987654-3',
                'telefono' => '3123456789',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
