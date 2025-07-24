<?php

use App\Http\Controllers\ProductoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Rutas para productos (Web)
Route::resource('productos', ProductoController::class);

// Rutas adicionales para productos
Route::patch('productos/{producto}/toggle-status', [ProductoController::class, 'toggleStatus'])
    ->name('productos.toggle-status');

Route::patch('productos/{producto}/update-stock', [ProductoController::class, 'updateStock'])
    ->name('productos.update-stock');
