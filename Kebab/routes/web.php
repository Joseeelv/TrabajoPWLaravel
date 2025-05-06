<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
})->name('home');


Route::get('/register', [RegisterController::class, 'create'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/login', [LoginController::class, 'show'])->name('login');
Route::post('/login', [LoginController::class, 'login']);


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
