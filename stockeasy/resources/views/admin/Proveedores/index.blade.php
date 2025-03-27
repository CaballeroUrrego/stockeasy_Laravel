@extends('layouts.admin')

@section('content')
<div class="container">
    <h1 class="mb-4">Administración de Proveedores</h1>
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalAgregar">Agregar Proveedor</button>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>NIT</th>
                <th>Teléfono</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($proveedores as $proveedor)
                <tr>
                    <td>{{ $proveedor->id_proveedor }}</td>
                    <td>{{ $proveedor->nombre }}</td>
                    <td>{{ $proveedor->nit }}</td>
                    <td>{{ $proveedor->telefono }}</td>
                    <td>
                        <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modalEditar{{ $proveedor->id_proveedor }}">Editar</button>
                        <form action="{{ route('admin.proveedores.destroy', $proveedor->id_proveedor) }}" method="POST" style="display:inline;">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                        </form>
                    </td>
                </tr>

                <!-- Modal Editar Proveedor -->
                <div class="modal fade" id="modalEditar{{ $proveedor->id_proveedor }}" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Editar Proveedor</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <form action="{{ route('admin.proveedores.update', $proveedor->id_proveedor) }}" method="POST">
                                @csrf @method('PUT')
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label>Nombre</label>
                                        <input type="text" class="form-control" name="nombre" value="{{ $proveedor->nombre }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label>NIT</label>
                                        <input type="text" class="form-control" name="nit" value="{{ $proveedor->nit }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label>Teléfono</label>
                                        <input type="text" class="form-control" name="telefono" value="{{ $proveedor->telefono }}" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                    <button type="submit" class="btn btn-primary">Guardar cambios</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Modal Agregar Proveedor -->
<div class="modal fade" id="modalAgregar" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Agregar Proveedor</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('admin.proveedores.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Nombre</label>
                        <input type="text" class="form-control" name="nombre" required>
                    </div>
                    <div class="mb-3">
                        <label>NIT</label>
                        <input type="text" class="form-control" name="nit" required>
                    </div>
                    <div class="mb-3">
                        <label>Teléfono</label>
                        <input type="text" class="form-control" name="telefono" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-success">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
