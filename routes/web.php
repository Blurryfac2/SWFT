<?php

use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\PublicProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CarouselImageController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactoController;
use Illuminate\Support\Facades\Route;

Route::get('/productos', [PublicProductController::class, 'index'])->name('public.products.index');

Route::get('/', [HomeController::class, 'home']);

Route::post('/contacto/enviar', [ContactoController::class, 'enviar'])->name('contacto.enviar');

Route::middleware('auth')->group(function () {
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('products', ProductController::class);
    });
    Route::resource('carousel', CarouselImageController::class);
    Route::get('contactos', [ContactoController::class, 'index'])->name('contactos.index');
});

Route::get('/historia', function () {
    return view('history');
});

Route::get('/contacto', function () {
    return view('contact');
});

Route::get('/politics', function () {
    return view('politics');
})->name('politics');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
