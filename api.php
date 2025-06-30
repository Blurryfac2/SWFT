<?php

use App\Http\Controllers\ProductoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// API Routes para productos
Route::prefix('productos')->group(function () {
    Route::get('/', [ProductoController::class, 'apiIndex']);
    Route::post('/', [ProductoController::class, 'apiStore']);
    Route::get('/{id}', [ProductoController::class, 'apiShow']);
    Route::put('/{id}', [ProductoController::class, 'apiUpdate']);
    Route::delete('/{id}', [ProductoController::class, 'apiDestroy']);
});
