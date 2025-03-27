<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index()
    {
        $usuarios = User::with('role')->get();
        $roles = Role::all(); // Asegura que se pasan los roles a la vista
        return view('admin.usuarios.index', compact('usuarios', 'roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'cedula' => 'required|string|max:20|unique:users,cedula',
            'password' => 'required|string|min:6',
            'id_rol' => 'required|exists:roles,id',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'cedula' => $request->cedula,
            'password' => Hash::make($request->password),
            'id_rol' => $request->id_rol,
        ]);

        return redirect()->route('admin.usuarios.index')->with('success', 'Usuario agregado correctamente.');
    }

    public function update(Request $request, User $usuario)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($usuario->id)],
            'cedula' => ['required', 'string', 'max:20', Rule::unique('users', 'cedula')->ignore($usuario->id)],
            'id_rol' => 'required|exists:roles,id',
            'password' => 'nullable|string|min:6',
        ]);

        $usuario->update([
            'name' => $request->name,
            'email' => $request->email,
            'cedula' => $request->cedula,
            'id_rol' => $request->id_rol,
            'password' => $request->password ? Hash::make($request->password) : $usuario->password,
        ]);

        return redirect()->route('admin.usuarios.index')->with('success', 'Usuario actualizado correctamente.');
    }

    public function destroy(User $usuario)
    {
        try {
            $usuario->delete();
            return redirect()->route('admin.usuarios.index')->with('success', 'Usuario eliminado correctamente.');
        } catch (\Exception $e) {
            return redirect()->route('admin.usuarios.index')->with('error', 'No se pudo eliminar el usuario.');
        }
    }
}
