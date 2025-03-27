@extends('layouts.vendedor')

@section('content')
<div class="container">
    <h2>Inventario de Productos</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Categoría</th>
                <th>Stock</th>
                <th>Precio</th>
            </tr>
        </thead>
        <tbody>
            @foreach($productos as $producto)
                <tr>
                    <td>{{ $producto->nombre }}</td>
                    <td>{{ $producto->categoria->nombre ?? 'Sin categoría' }}</td> 
                    <td>{{ $producto->stock }}</td>
                    <td>${{ number_format($producto->precio, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
