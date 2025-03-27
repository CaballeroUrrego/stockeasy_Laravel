<?php

namespace App\Http\Controllers;

use App\Models\Proveedor;
use Illuminate\Http\Request;

class ProveedorController extends Controller
{
    public function index()
    {
        $proveedores = Proveedor::all();
        return view('admin.proveedores.index', compact('proveedores'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'nit' => 'required|string|max:50|unique:proveedores,nit',
            'telefono' => 'required|string|max:20',
        ]);

        Proveedor::create([
            'nombre' => $request->nombre,
            'nit' => $request->nit,
            'telefono' => $request->telefono,
        ]);

        return redirect()->route('admin.proveedores.index')->with('success', 'Proveedor agregado correctamente');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'nit' => 'required|string|max:50|unique:proveedores,nit,' . $id . ',id_proveedor',
            'telefono' => 'required|string|max:20',
        ]);

        $proveedor = Proveedor::findOrFail($id);
        $proveedor->update([
            'nombre' => $request->nombre,
            'nit' => $request->nit,
            'telefono' => $request->telefono,
        ]);

        return redirect()->route('admin.proveedores.index')->with('success', 'Proveedor actualizado correctamente');
    }

    public function destroy($id)
    {
        $proveedor = Proveedor::findOrFail($id);
        $proveedor->delete();
        return redirect()->route('admin.proveedores.index')->with('success', 'Proveedor eliminado correctamente');
    }
}
