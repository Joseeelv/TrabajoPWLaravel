<?php

use App\Http\Controllers\Dashboard;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\MenuController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

// Ruta del dashboard para el usuario cliente
Route::middleware(['auth'])->get('/dashboard', function () {
    $user = Auth::user();
    return view('dashboard', ['points' => 0]); // o reemplaza 0 por $user->points
})->name('dashboard');

// Ruta de perfil
Route::middleware(['auth'])->get('/perfil', function () {
    return view('perfil');
});
Route::middleware(['auth'])->group(function () {
    Route::get('/manager', function () {
        return view('manager.index');
    });
    Route::get('/manager/replenishment', function () {
        // Aquí puedes redirigir a tu vista o controlador real
    });
    Route::get('/manager/transactions', function () {
        // Igual que arriba
    });
    Route::get('/perfil', function () {
        // Perfil del usuario
    });
});
