<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    public function run()
    {
        DB::table('productos')->insert([
            [
                'nombre' => 'Laptop HP 15"',
                'precio' => 2500000.00,
                'stock' => 10,
                'id_categoria' => 1, // Asegúrate de que existan estas categorías
                'id_proveedor' => 1, // Asegúrate de que existan estos proveedores
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Teclado Mecánico RGB',
                'precio' => 350000.00,
                'stock' => 15,
                'id_categoria' => 2,
                'id_proveedor' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Monitor Samsung 24"',
                'precio' => 800000.00,
                'stock' => 5,
                'id_categoria' => 3,
                'id_proveedor' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
