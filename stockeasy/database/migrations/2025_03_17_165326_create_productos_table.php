<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    
        public function up()
        {
            Schema::create('productos', function (Blueprint $table) {
                $table->id('id_producto');
                $table->string('nombre', 100);
                $table->decimal('precio', 10, 2);
                $table->integer('stock');
                $table->foreignId('id_categoria')->constrained('categorias', 'id_categoria')->onDelete('cascade');
                $table->foreignId('id_proveedor')->constrained('proveedores', 'id_proveedor')->onDelete('cascade');
                $table->timestamps();
            });
        }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
