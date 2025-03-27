@extends('layouts.vendedor')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Dashboard Vendedor</h1>
    
    <div class="row">
        <div class="col-md-3">
            <div class="card text-white bg-primary mb-3">
                <div class="card-body">
                    <h5 class="card-title">Ventas del Mes</h5>
                    <p class="card-text">$ {{ number_format($ventasMes, 2) }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-success mb-3">
                <div class="card-body">
                    <h5 class="card-title">Total de Productos</h5>
                    <p class="card-text">{{ $totalProductos }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-warning mb-3">
                <div class="card-body">
                    <h5 class="card-title">Stock Bajo</h5>
                    <p class="card-text">{{ $productosStockBajo->count() }} productos</p>
                </div>
            </div>
        </div>
    </div>

    <h3>Productos Vendidos este Mes</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Producto</th>
                <th>Cantidad</th>
            </tr>
        </thead>
        <tbody>
            @foreach($productosVendidos as $detalle)
                <tr>
                    <td>{{ $detalle->producto->nombre }}</td>
                    <td>{{ $detalle->cantidad }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h3>Productos con Stock Bajo</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Producto</th>
                <th>Stock Disponible</th>
            </tr>
        </thead>
        <tbody>
            @foreach($productosStockBajo as $producto)
                <tr>
                    <td>{{ $producto->nombre }}</td>
                    <td>{{ $producto->stock }}</td>
                </tr>
            @endforeach 
        </tbody>
    </table>
</div>
@endsection