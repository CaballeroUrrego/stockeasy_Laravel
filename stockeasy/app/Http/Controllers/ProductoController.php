<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Proveedor;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function index()
    {
        $productos = Producto::with(['categoria', 'proveedor'])->get();
        $categorias = Categoria::all();
        $proveedores = Proveedor::all();
        return view('admin.productos.index', compact('productos', 'categorias', 'proveedores'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'precio' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'id_categoria' => 'required|exists:categorias,id_categoria',
            'id_proveedor' => 'required|exists:proveedores,id_proveedor',
        ]);

        Producto::create([
            'nombre' => $request->nombre,
            'precio' => $request->precio,
            'stock' => $request->stock,
            'id_categoria' => $request->id_categoria,
            'id_proveedor' => $request->id_proveedor,
        ]);

        return redirect()->route('admin.productos.index')->with('success', 'Producto agregado correctamente');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'precio' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'id_categoria' => 'required|exists:categorias,id_categoria',
            'id_proveedor' => 'required|exists:proveedores,id_proveedor',
        ]);

        $producto = Producto::findOrFail($id);
        $producto->update([
            'nombre' => $request->nombre,
            'precio' => $request->precio,
            'stock' => $request->stock,
            'id_categoria' => $request->id_categoria,
            'id_proveedor' => $request->id_proveedor,
        ]);

        return redirect()->route('admin.productos.index')->with('success', 'Producto actualizado correctamente');
    }

    public function destroy($id)
    {
        $producto = Producto::findOrFail($id);
        $producto->delete();
        return redirect()->route('admin.productos.index')->with('success', 'Producto eliminado correctamente');
    }
    public function storeCategoria(Request $request)
{
    $request->validate([
        'nombre' => 'required|string|max:255|unique:categorias,nombre',
    ]);

    Categoria::create([
        'nombre' => $request->nombre,
    ]);

    return redirect()->route('admin.productos.index')->with('success', 'Categoría agregada correctamente');
}
}
