<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
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
