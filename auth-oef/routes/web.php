<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TodoController;
use Illuminate\Support\Facades\Route;

Route::get('/', [TodoController::class, 'index'])->name('todos.index');
Route::post('/', [TodoController::class, 'store'])->name('todos.store');
Route::put('/{todo}', [TodoController::class, 'toggle'])->name('todos.toggle');
Route::delete('/{todo}', [TodoController::class, 'destroy'])->name('todos.delete');

Route::get('/login', [AuthController::class, 'login'])->name('login.get');
Route::post('/login', [AuthController::class, 'handleLogin'])->name('login.post');
Route::get('/register', [AuthController::class, 'register'])->name('register.get');
Route::post('/register', [AuthController::class, 'handleRegister'])->name('register.post');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
