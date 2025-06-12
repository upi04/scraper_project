<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LaptopController ;



Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/laptop/input', [LaptopController ::class, 'showInputForm'])->middleware('auth');
Route::post('/laptop/input', [LaptopController ::class, 'store'])->middleware('auth');

// Halaman list laptop
Route::get('/laptop/list', [LaptopController::class, 'index'])->name('laptop.index');

// Edit data laptop
Route::get('/laptop/edit/{id}', [LaptopController::class, 'edit'])->middleware('auth');
Route::post('/laptop/update/{id}', [LaptopController::class, 'update'])->middleware('auth');

// Hapus data laptop
Route::post('/laptop/delete/{id}', [LaptopController::class, 'destroy'])->middleware('auth');

Route::post('/laptop/mark-sold', [LaptopController::class, 'markSold'])->name('laptop.markSold');

Route::get('/laptop/terjual', [LaptopController::class, 'sold'])->name('laptop.sold');

Route::get('/', [LaptopController::class, 'dashboard'])->middleware('auth')->name('dashboard');

