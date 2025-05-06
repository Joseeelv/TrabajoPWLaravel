<?php

use App\Http\Controllers\CarritoController;
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

// Ruta a vista de Producto
Route::get('/producto/{id}', [ProductoController::class, 'mostrar'])->name('producto');

// Ruta a manejo de información
Route::get('/add-to-carrito', [CarritoController::class, 'add'])->name('carrito');

// Ruta a carrito
Route::get('carrito', [CarritoController::class, 'view'])->name('carrito');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
});

require __DIR__.'/auth.php';
