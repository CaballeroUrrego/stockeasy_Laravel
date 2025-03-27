@extends('layouts.admin')

@section('content')
<div class="container">
    <h1 class="mb-4">Administración de Productos</h1>
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalAgregar">Agregar Producto</button>
    <button class="btn btn-secondary mb-3" data-bs-toggle="modal" data-bs-target="#modalAgregarCategoria">Agregar Categoría</button>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Stock</th>
                <th>Categoría</th>
                <th>Proveedor</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($productos as $producto)
                <tr>
                    <td>{{ $producto->id_producto }}</td>
                    <td>{{ $producto->nombre }}</td>
                    <td>${{ number_format($producto->precio, 2) }}</td>
                    <td>{{ $producto->stock }}</td>
                    <td>{{ $producto->categoria->nombre ?? 'Sin categoría' }}</td>
                    <td>{{ $producto->proveedor->nombre ?? 'Sin proveedor' }}</td>
                    <td>
                        <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modalEditar{{ $producto->id_producto }}">Editar</button>
                        <form action="{{ route('admin.productos.destroy', $producto->id_producto) }}" method="POST" style="display:inline;">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                        </form>
                    </td>
                </tr>
                
                <!-- Modal Editar Producto -->
                <div class="modal fade" id="modalEditar{{ $producto->id_producto }}" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Editar Producto</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <form action="{{ route('admin.productos.update', $producto->id_producto) }}" method="POST">
                                @csrf @method('PUT')
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label>Nombre</label>
                                        <input type="text" class="form-control" name="nombre" value="{{ $producto->nombre }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label>Precio</label>
                                        <input type="number" class="form-control" name="precio" step="0.01" value="{{ $producto->precio }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label>Stock</label>
                                        <input type="number" class="form-control" name="stock" value="{{ $producto->stock }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label>Categoría</label>
                                        <select class="form-control" name="id_categoria">
                                            @foreach ($categorias as $categoria)
                                                <option value="{{ $categoria->id_categoria }}" {{ $producto->id_categoria == $categoria->id_categoria ? 'selected' : '' }}>{{ $categoria->nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label>Proveedor</label>
                                        <select class="form-control" name="id_proveedor">
                                            @foreach ($proveedores as $proveedor)
                                                <option value="{{ $proveedor->id_proveedor }}" {{ $producto->id_proveedor == $proveedor->id_proveedor ? 'selected' : '' }}>{{ $proveedor->nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                    <button type="submit" class="btn btn-success">Guardar cambios</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                
            @endforeach
        </tbody>
    </table>
</div>

<!-- Modal Agregar Producto -->
<div class="modal fade" id="modalAgregar" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Agregar Producto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('admin.productos.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Nombre</label>
                        <input type="text" class="form-control" name="nombre" required>
                    </div>
                    <div class="mb-3">
                        <label>Precio</label>
                        <input type="number" class="form-control" name="precio" step="0.01" required>
                    </div>
                    <div class="mb-3">
                        <label>Stock</label>
                        <input type="number" class="form-control" name="stock" required>
                    </div>
                    <div class="mb-3">
                        <label>Categoría</label>
                        <select class="form-control" name="id_categoria">
                            @foreach ($categorias as $categoria)
                                <option value="{{ $categoria->id_categoria }}">{{ $categoria->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>Proveedor</label>
                        <select class="form-control" name="id_proveedor">
                            @foreach ($proveedores as $proveedor)
                                <option value="{{ $proveedor->id_proveedor }}">{{ $proveedor->nombre }}</option>
                            @endforeach
                        </select>
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

<!-- Modal Agregar Categoría -->
<div class="modal fade" id="modalAgregarCategoria" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Agregar Categoría</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('admin.categorias.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Nombre</label>
                        <input type="text" class="form-control" name="nombre" required>
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