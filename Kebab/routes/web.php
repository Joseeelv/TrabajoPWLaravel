<?php

use App\Http\Controllers\Dashboard;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\CarritoController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Manager\ReplenishmentController;
use App\Http\Controllers\Manager\TransactionController;
// Página de inicio
Route::get('/', function () {
    return view('index');
})->name('home');

// Rutas de menú y contacto
Route::get('/menu', [MenuController::class, 'index'])->name('menu');
Route::view('/contact', 'contact')->name('contact');

// Ruta de producto seleccionado en carta y archivo de inclusión a carrito
Route::get('/producto', [ProductoController::class, 'mostrar']);
Route::post('/producto', [ProductoController::class, 'mostrar'])->name('producto');
Route::post('/add-to-cart', [CarritoController::class, 'agregar']);

// Rutas de registro y login
Route::get('/register', [RegisterController::class, 'create'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
Route::get('/login', [LoginController::class, 'show'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Ruta del dashboard para el usuario cliente
Route::middleware(['auth'])->get('/dashboard', function () {
    $user = Auth::user();
    return view('dashboard', ['points' => $user->points, 'user' => $user]);
})->name('dashboard');

// Ruta de perfil
Route::middleware(['auth'])->get('/perfil', function () {
    return view('perfil');
});

// Ruta de manager  
Route::middleware(['auth'])->group(function () {
    Route::get('/manager', function () {
        return view('manager.index');
    });
    Route::get('/manager/replenishment', [ReplenishmentController::class, 'index'])->name('manager.replenishment');
    Route::post('/manager/replenishment', [ReplenishmentController::class, 'store'])->name('manager.replenishment.store');
    Route::get('/manager/transactions', [TransactionController::class, 'index'])->name('manager.transaction');

});
