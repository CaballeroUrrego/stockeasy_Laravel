<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\VendedorDashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Ruta principal
Route::get('/', function () {
    return Auth::check() ? redirect()->route(Auth::user()->role->nombre . '.dashboard') : redirect()->route('login');
});

// Rutas de perfil
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Rutas para Vendedores
Route::middleware(['auth', 'role:vendedor'])->group(function () {
    Route::get('/vendedor', [VendedorDashboardController::class, 'index'])->name('vendedor.dashboard');
    Route::get('/vendedor/inventario', [VendedorDashboardController::class, 'inventario'])->name('vendedor.inventario');
    Route::get('/vendedor/ventas/crear', [VendedorDashboardController::class, 'createVenta'])->name('vendedor.ventas.create');
    Route::post('/vendedor/ventas', [VendedorDashboardController::class, 'storeVenta'])->name('vendedor.ventas.store');
    Route::get('/vendedor/ventas', [VendedorDashboardController::class, 'ventas'])->name('vendedor.ventas');
});

// Rutas para Administradores
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');

    // Gestión de Usuarios
    Route::resource('/admin/usuarios', UserController::class)->names('admin.usuarios');

    // Gestión de Productos
    Route::resource('/admin/productos', ProductoController::class)->except(['destroy'])->names('admin.productos');
    Route::delete('/admin/productos/{producto}', [ProductoController::class, 'destroy'])->name('admin.productos.destroy');
    Route::put('admin/productos/{producto}', [ProductoController::class, 'update'])->name('admin.productos.update');
    Route::post('/admin/categorias/store', [ProductoController::class, 'storeCategoria'])->name('admin.categorias.store');

    // Gestión de Proveedores
    Route::resource('/admin/proveedores', ProveedorController::class)->names('admin.proveedores');

    // Ruta para agregar categorías desde el controlador de productos
    Route::post('/admin/categorias/store', [ProductoController::class, 'storeCategoria'])->name('admin.categorias.store');

    // Otras rutas
    Route::get('/admin/ventas', [AdminController::class, 'ventas'])->name('admin.ventas');
});

require __DIR__.'/auth.php';
