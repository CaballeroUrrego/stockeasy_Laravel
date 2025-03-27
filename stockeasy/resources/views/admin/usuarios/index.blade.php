@extends('layouts.admin')

@section('content')
<div class="container">
    <h1 class="mb-4">Administración de Usuarios</h1>
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalAgregar">Agregar Usuario</button>
    
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Cédula</th>
                <th>Rol</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($usuarios as $usuario)
                <tr>
                    <td>{{ $usuario->id }}</td>
                    <td>{{ $usuario->name }}</td>
                    <td>{{ $usuario->email }}</td>
                    <td>{{ $usuario->cedula }}</td>
                    <td>{{ $usuario->role->nombre ?? 'Sin rol' }}</td>
                    <td>
                        <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modalEditar{{ $usuario->id }}">Editar</button>
                        <form action="{{ route('admin.usuarios.destroy', $usuario->id) }}" method="POST" style="display:inline;">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                        </form>
                    </td>
                </tr>

                <!-- Modal Editar Usuario -->
                <div class="modal fade" id="modalEditar{{ $usuario->id }}" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Editar Usuario</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <form action="{{ route('admin.usuarios.update', $usuario->id) }}" method="POST">
                                @csrf @method('PUT')
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label>Nombre</label>
                                        <input type="text" class="form-control" name="name" value="{{ old('name', $usuario->name) }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label>Email</label>
                                        <input type="email" class="form-control" name="email" value="{{ old('email', $usuario->email) }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label>Cédula</label>
                                        <input type="text" class="form-control" name="cedula" value="{{ old('cedula', $usuario->cedula) }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label>Rol</label>
                                        <select class="form-control" name="id_rol">
                                            @foreach($roles as $rol)
                                                <option value="{{ $rol->id }}" {{ $usuario->id_rol == $rol->id ? 'selected' : '' }}>
                                                    {{ $rol->nombre }}
                                                </option>
                                            @endforeach
                                        </select>
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

<!-- Modal Agregar Usuario -->
<div class="modal fade" id="modalAgregar" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Agregar Usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('admin.usuarios.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Nombre</label>
                        <input type="text" class="form-control" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label>Email</label>
                        <input type="email" class="form-control" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label>Cédula</label>
                        <input type="text" class="form-control" name="cedula" required>
                    </div>
                    <div class="mb-3">
                        <label>Contraseña</label>
                        <input type="password" class="form-control" name="password" required>
                    </div>
                    <div class="mb-3">
                        <label>Rol</label>
                        <select class="form-control" name="id_rol">
                            @foreach($roles as $rol)
                                <option value="{{ $rol->id }}">{{ $rol->nombre }}</option>
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
@endsection
