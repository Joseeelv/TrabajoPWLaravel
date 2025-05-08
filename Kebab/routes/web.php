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
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
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
Route::middleware(['auth'])->group(function () {
    Route::get('/perfil', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/perfil', [ProfileController::class, 'update'])->name('profile.update');
});


// Ruta de manager  
Route::middleware(['auth'])->group(function () {
    Route::get('/manager', function () {
        return view('manager.index');
    })->name('manager.index');
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


Route::middleware(['auth'])->group(function () {
    Route::get('/adminPanel', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
    Route::get('/adminPanel/empleados', function () {
        $activeManagers = \App\Models\Manager::where('employee', '1')->get();
        $inactiveManagers = \App\Models\Manager::where('employee', 'inactive')->get();
        return view('admin.employees.index', [
            'activeManagers' => $activeManagers,
            'inactiveManagers' => $inactiveManagers,
        ]);
    })->name('admin.employees.index');
    Route::get('/adminPanel/contratar', function () {
        $activeManagers = \App\Models\Manager::where('employee', 1)->get();
        $inactiveManagers = \App\Models\Manager::where('employee', 0)->get();
        return view('admin.employees.hire', [
            'activeManagers' => $activeManagers,
            'inactiveManagers' => $inactiveManagers,
        ]);
    })->name('admin.employees.hire');
    Route::post('/adminPanel/contratar', [EmployeeController::class, 'hire'])->name('admin.employees.hire');
    Route::post('/adminPanel/recontratar', [EmployeeController::class, 'hire'])->name('admin.employees.rehire');
    Route::post('/adminPanel/despedir', [EmployeeController::class, 'fire'])->name('admin.employees.fire');
});

Route::get('password/forgot', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');
