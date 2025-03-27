<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Proveedor;
use App\Models\Venta;
use App\Models\DetalleVenta;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        // ✅ Total de productos vendidos en el mes
        $productosVendidos = DetalleVenta::whereHas('venta', function ($query) {
            $query->whereMonth('fecha', now()->month);
        })->sum('cantidad');

        // ✅ Total de ventas del mes
        $totalVentas = Venta::whereMonth('fecha', now()->month)->sum('total');

        // ✅ Productos con bajo stock (menos de 5 unidades)
        $productosBajoStock = Producto::where('stock', '<', 5)->get();

        // ✅ Total de productos, categorías y proveedores
        $totalProductos = Producto::count();
        $totalCategorias = Categoria::count();
        $totalProveedores = Proveedor::count();

        return view('admin.dashboard', compact(
            'productosVendidos', 
            'totalVentas',
            'productosBajoStock',
            'totalProductos',
            'totalCategorias',
            'totalProveedores'
        ));
    }

    public function ventas()
    {
        // ✅ Cargar usuario y detalles con productos
        $ventas = Venta::with('usuario', 'detalles.producto')
            ->orderByDesc('fecha')
            ->get();

        return view('admin.ventas', compact('ventas'));
    }
}
