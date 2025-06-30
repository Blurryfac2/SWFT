<?php

use App\Http\Controllers\ProductoController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

// Rutas de autenticación
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Rutas protegidas por autenticación
Route::middleware('auth')->group(function () {

    // Rutas para todos los usuarios autenticados (test, admin_base, admin_full)
    Route::middleware('rol:test,admin_base,admin_full')->group(function () {
        Route::get('productos', [ProductoController::class, 'index'])->name('productos.index');
        Route::get('productos/{producto}', [ProductoController::class, 'show'])->name('productos.show');
    });

    // Rutas solo para administradores (admin_base y admin_full)
    Route::middleware('rol:admin_base,admin_full')->group(function () {
        Route::get('productos/create', [ProductoController::class, 'create'])->name('productos.create');
        Route::post('productos', [ProductoController::class, 'store'])->name('productos.store');
        Route::get('productos/{producto}/edit', [ProductoController::class, 'edit'])->name('productos.edit');
        Route::put('productos/{producto}', [ProductoController::class, 'update'])->name('productos.update');
        Route::delete('productos/{producto}', [ProductoController::class, 'destroy'])->name('productos.destroy');
        Route::patch('productos/{producto}/toggle-status', [ProductoController::class, 'toggleStatus'])->name('productos.toggle-status');
        Route::patch('productos/{producto}/update-stock', [ProductoController::class, 'updateStock'])->name('productos.update-stock');
    });

    // Rutas solo para usuarios test
    Route::middleware('rol:test')->group(function () {
        Route::get('descargar-logs', [ProductoController::class, 'descargarLogs'])->name('descargar.logs');
    });

    // Rutas solo para administradores full (acciones críticas)
    Route::middleware('rol:admin_full')->group(function () {
        Route::delete('productos-todos', [ProductoController::class, 'destroyAll'])->name('productos.destroy-all');
        Route::post('limpiar-logs', [ProductoController::class, 'limpiarLogs'])->name('limpiar.logs');
    });
});
