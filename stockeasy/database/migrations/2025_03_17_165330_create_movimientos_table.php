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
        Schema::create('movimientos', function (Blueprint $table) {
            $table->id('id_movimiento');
            $table->foreignId('id_usuario')->constrained('users', 'id')->onDelete('cascade');
            $table->foreignId('id_producto')->constrained('productos', 'id_producto')->onDelete('cascade');
            $table->integer('cantidad');
            $table->string('tipo', 50); // 'entrada' o 'salida'
            $table->dateTime('fecha')->default(now());
            $table->timestamps();
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movimientos');
    }
};
