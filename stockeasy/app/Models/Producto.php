<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $table = 'productos';
    protected $primaryKey = 'id_producto';
    public $timestamps = false;

    protected $fillable = ['nombre', 'precio', 'stock', 'id_categoria', 'id_proveedor'];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'id_categoria');
    }

    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class, 'id_proveedor');
    }

    public function detalleVentas()
    {
        return $this->hasMany(DetalleVenta::class, 'id_producto');
    }

    public function movimientos()
    {
        return $this->hasMany(Movimiento::class, 'id_producto');
    }
}
