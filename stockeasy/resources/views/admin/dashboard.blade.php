@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Panel de Administración</h2>

    <div class="row">
        <div class="col-md-4">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <h5 class="card-title">Total de Ventas del Mes</h5>
                    <p class="card-text">${{ number_format($totalVentas ?? 0, 2) }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card bg-info text-white">
                <div class="card-body">
                    <h5 class="card-title">Total de Productos Vendidos</h5>
                    <p class="card-text">{{ $productosVendidos ?? 0 }} unidades</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card bg-warning text-dark">
                <div class="card-body">
                    <h5 class="card-title">Productos con Bajo Stock</h5>
                    <p class="card-text">{{ $productosBajoStock->count() ?? 0 }} productos</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-md-4">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <h5 class="card-title">Total de Productos</h5>
                    <p class="card-text">{{ $totalProductos ?? 0 }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card bg-secondary text-white">
                <div class="card-body">
                    <h5 class="card-title">Total de Categorías</h5>
                    <p class="card-text">{{ $totalCategorias ?? 0 }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card bg-danger text-white">
                <div class="card-body">
                    <h5 class="card-title">Total de Proveedores</h5>
                    <p class="card-text">{{ $totalProveedores ?? 0 }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
