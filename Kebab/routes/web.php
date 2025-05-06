<?php

use App\Http\Controllers\Dashboard;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\MenuController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
})->name('home');

Route::get('/menu', [MenuController::class, 'index'])->name('menu');
Route::post('/menu', [MenuController::class, 'index']);
Route::view('/contact', 'contact')->name('contact');

Route::get('/register', [RegisterController::class, 'create'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/login', [LoginController::class, 'show'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


Route::get('/dashboard', [Dashboard::class, 'dashboard'])->name('dashboard');


// Route::get('/forgot-password', function () {
//     return view('auth.forgot-password');
// })->name('password.request');


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



