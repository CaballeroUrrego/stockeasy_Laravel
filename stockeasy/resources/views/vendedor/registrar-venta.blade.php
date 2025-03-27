@extends('layouts.vendedor')

@section('content')
<div class="container">
    <h2>Registrar Venta</h2>

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('vendedor.ventas.store') }}" method="POST">
        @csrf

        <table class="table">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Stock Disponible</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                </tr>
            </thead>
            <tbody>
                @foreach($productos as $producto)
                    <tr>
                        <td>{{ $producto->nombre }}</td>
                        <td>{{ $producto->stock }}</td>
                        <td>${{ number_format($producto->precio, 2) }}</td>
                        <td>
                            <input type="number" 
                                   name="productos[{{ $producto->id_producto }}][cantidad]" 
                                   min="0" max="{{ $producto->stock }}" 
                                   class="form-control" 
                                   value="0" required>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <button type="submit" class="btn btn-primary">Registrar Venta</button>
    </form>
</div>
@endsection
