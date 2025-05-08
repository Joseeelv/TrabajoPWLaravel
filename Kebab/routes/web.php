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
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CarritoCheckController;
use App\Http\Controllers\ConfirmarCarritoController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\OfertaController;
// Página de inicio
Route::get('/', function () {
    return view('index');
})->name('home');

// Rutas de menú y contacto
Route::get('/menu', [MenuController::class, 'index'])->name('menu');
Route::view('/contact', 'contact')->name('contact');



// Rutas de registro y login
Route::get('/register', [RegisterController::class, 'create'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
Route::get('/login', [LoginController::class, 'show'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Rutas para el usuario cliente
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        $user = Auth::user();
        return view('dashboard', ['points' => $user->points, 'user' => $user]);
    })->name('dashboard');

    Route::get('/ofertas', [OfertaController::class, 'index'])->name('ofertas');
    Route::post('/ofertas/activar', [OfertaController::class, 'activate'])->name('ofertas.activar');
    // Ruta de producto seleccionado en carta y archivo de inclusión a carrito
    Route::get('/producto', [ProductoController::class, 'mostrar']);
    Route::post('/producto', [ProductoController::class, 'mostrar'])->name('producto');
    Route::post('/add-to-cart', [CarritoController::class, 'agregar']);
    Route::get('/reviews', [ReviewController::class, 'index'])->name('reviews');
    Route::post('/reviews', [ReviewController::class, 'store'])->middleware('auth')->name('reviews.store');
});

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
    Route::get('/manager/reviews', [ReviewController::class, 'managerIndex'])->name('manager.reviews.index');
    Route::get('/review/{id}/responder', [ReviewController::class, 'respondForm'])->name('manager.reviews.respond.form');
    Route::post('/review/{id}/responder', [ReviewController::class, 'respond'])->name('manager.reviews.respond');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/pedidos', [OrderController::class, 'index'])->name('orders.index');
});


Route::get('/carrito', [CarritoCheckController::class, 'index'])->name('carrito.index');
Route::post('/confirmar-compra', [ConfirmarCarritoController::class, 'confirmar'])->name('carrito.confirmar');
Route::get('/pedido-confirmado', function () {
    return view('pedido_confirmado');
})->name('pedido.confirmado');