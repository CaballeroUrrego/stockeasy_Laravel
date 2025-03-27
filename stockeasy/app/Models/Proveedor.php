<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    use HasFactory;

    protected $table = 'proveedores';
    protected $primaryKey = 'id_proveedor';
    public $timestamps = true;

    protected $fillable = ['nombre', 'nit', 'telefono'];

    public function productos()
    {
        return $this->hasMany(Producto::class, 'id_proveedor');
    }
}
