<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Venta;
use App\Models\Producto;
use App\Models\DetalleVenta;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class VendedorDashboardController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $currentMonth = Carbon::now()->month;

        $ventasMes = Venta::where('id_usuario', $userId)
            ->whereMonth('fecha', $currentMonth)
            ->sum('total');

        $productosVendidos = DetalleVenta::whereHas('venta', function ($query) use ($userId, $currentMonth) {
                $query->where('id_usuario', $userId)
                    ->whereMonth('fecha', $currentMonth);
            })
            ->with('producto')
            ->get();

        $productosStockBajo = Producto::where('stock', '<=', 5)->get();
        $totalProductos = Producto::count();

        return view('vendedor.dashboard', compact('ventasMes', 'productosVendidos', 'productosStockBajo', 'totalProductos'));
    }

    public function inventario()
    {
        $productos = Producto::with('categoria')->get();
        return view('vendedor.inventario', compact('productos'));
    }

    // Vista para registrar ventas
    public function createVenta()
    {
        $productos = Producto::where('stock', '>', 0)->get();
        return view('vendedor.registrar-venta', compact('productos'));
    }

    // Procesar venta
  public function storeVenta(Request $request)
{
    $productosSeleccionados = collect($request->productos)
        ->filter(fn($producto) => $producto['cantidad'] > 0); // Filtra los productos con cantidad mayor a 0

    if ($productosSeleccionados->isEmpty()) {
        return redirect()->back()->with('error', 'Debes seleccionar al menos un producto.');
    }

    DB::beginTransaction();
    try {
        $usuarioId = Auth::id();
        $totalVenta = 0;

        // Crear la venta
        $venta = Venta::create([
            'id_usuario' => $usuarioId,
            'fecha' => Carbon::now(),
            'total' => 0, // Se actualizará después
        ]);

        // Registrar detalles y actualizar stock
        foreach ($productosSeleccionados as $idProducto => $productoSeleccionado) {
            $producto = Producto::findOrFail($idProducto);

            if ($producto->stock < $productoSeleccionado['cantidad']) {
                return redirect()->back()->with('error', "Stock insuficiente para {$producto->nombre}");
            }

            $subtotal = $producto->precio * $productoSeleccionado['cantidad'];
            $totalVenta += $subtotal;

            DetalleVenta::create([
                'id_venta' => $venta->id_venta,
                'id_producto' => $producto->id_producto,
                'cantidad' => $productoSeleccionado['cantidad'],
                'precio_unitario' => $producto->precio,
            ]);

            // Descontar stock
            $producto->decrement('stock', $productoSeleccionado['cantidad']);
        }

        // Actualizar el total de la venta
        $venta->update(['total' => $totalVenta]);

        DB::commit();
        return redirect()->route('vendedor.dashboard')->with('success', 'Venta registrada exitosamente.');
    } catch (\Exception $e) {
        DB::rollBack();
        return redirect()->back()->with('error', 'Error al registrar la venta.');
    }
}
public function ventas()
{
    $usuarioId = Auth::id();
    $ventas = Venta::where('id_usuario', $usuarioId)
        ->with('detalles.producto') // Cargar detalles y productos en una sola consulta
        ->orderByDesc('fecha')
        ->get();

    return view('vendedor.ventas', compact('ventas'));
}
}
