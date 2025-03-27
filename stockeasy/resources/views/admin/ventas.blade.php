@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Todas las Ventas</h2>

    <table class="table">
        <thead>
            <tr>
                <th>Fecha</th>
                <th>Usuario</th>
                <th>Total</th>
                <th>Productos</th>
            </tr>
        </thead>
        <tbody>
            @foreach($ventas as $venta)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($venta->fecha)->format('d/m/Y H:i') }}</td>
                    <td>{{ $venta->usuario->name ?? 'Usuario Eliminado' }}</td>
                    <td>${{ number_format($venta->total, 2) }}</td>
                    <td>
                        <ul>
                            @foreach($venta->detalles as $detalle)
                                <li>{{ $detalle->producto->nombre }} ({{ $detalle->cantidad }} unidades) - ${{ number_format($detalle->precio_unitario, 2) }}</li>
                            @endforeach
                        </ul>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
