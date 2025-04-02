@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Todas las Ventas</h2>

    <!-- Botón para generar PDF -->
    <button id="generate-pdf" class="btn btn-primary mb-3">Generar PDF</button>

    <table class="table" id="ventas-table">
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

<!-- Script para generar PDF -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
<script>
    document.getElementById('generate-pdf').addEventListener('click', function () {
        const { jsPDF } = window.jspdf;
        const doc = new jsPDF();

        // Agregar título
        doc.text('Reporte de Ventas', 10, 10);

        // Obtener la tabla
        const table = document.getElementById('ventas-table');
        let y = 20;

        // Recorrer las filas de la tabla
        for (let i = 0, row; row = table.rows[i]; i++) {
            let rowText = '';
            for (let j = 0, col; col = row.cells[j]; j++) {
                rowText += col.innerText + ' | ';
            }
            doc.text(rowText, 10, y);
            y += 10;
        }

        // Guardar el PDF
        doc.save('ventas.pdf');
    });
</script>
@endsection
