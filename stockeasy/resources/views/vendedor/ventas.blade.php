{{-- filepath: c:\Users\se302\Documents\PROGRAMACION\stockeasy_Larave\stockeasy\resources\views\vendedor\ventas.blade.php --}}
@extends('layouts.vendedor')

@section('content')
<div class="container">
    <h2>Mis Ventas</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Botón para generar PDF --}}
    <button id="generate-pdf" class="btn btn-primary mb-3">Generar PDF</button>

    <table class="table" id="ventas-table">
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

{{-- Script para generar PDF --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
<script>
    document.getElementById('generate-pdf').addEventListener('click', function () {
        const { jsPDF } = window.jspdf;
        const doc = new jsPDF();

        // Agregar título
        doc.text('Mis Ventas', 10, 10);

        // Obtener la tabla
        const ventasTable = document.getElementById('ventas-table');
        let y = 20;

        // Recorrer las filas de la tabla
        for (let row of ventasTable.rows) {
            let rowText = '';
            for (let cell of row.cells) {
                rowText += cell.innerText + ' | ';
            }
            doc.text(rowText, 10, y);
            y += 10;
        }

        // Descargar el PDF
        doc.save('ventas.pdf');
    });
</script>
@endsection
