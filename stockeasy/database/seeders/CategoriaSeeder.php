<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriaSeeder extends Seeder
{
    public function run()
    {
        DB::table('categorias')->insert([
            ['nombre' => 'Laptops', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Periféricos', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Monitores', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Impresoras', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
