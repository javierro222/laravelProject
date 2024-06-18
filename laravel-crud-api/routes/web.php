<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/usuarios', [App\Http\Controllers\UserController::class, 'index'])->name('usuarios');
Route::get('users/create', [App\Http\Controllers\UserController::class, 'create'])->name('users.create');
Route::get('users/store', [App\Http\Controllers\UserController::class, 'store'])->name('users.store');