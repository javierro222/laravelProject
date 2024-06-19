<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

// Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/usuarios', [App\Http\Controllers\UserController::class, 'index'])->name('usuarios');
Route::resource('users', UserController::class);
Route::get('users/create', [App\Http\Controllers\UserController::class, 'create'])->name('users.create');
Route::post('users/store', [App\Http\Controllers\UserController::class, 'store'])->name('users.store');