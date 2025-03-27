@extends('layouts.vendedor')

@section('content')
<div class="container">
    <h2>Mis Ventas</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>Fecha</th>
                <th>Total</th>
                <th>Productos</th>
            </tr>
        </thead>
        <tbody>
            @foreach($ventas as $venta)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($venta->fecha)->format('d/m/Y H:i') }}</td>
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
