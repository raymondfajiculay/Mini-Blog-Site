<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', 'posts');

Route::resource('posts', PostController::class);

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/dashboard', [DashboardController::class,'index'])->middleware('auth')->name('dashboard');
});

Route::middleware('guest')->group(function () {
    Route::view('/register','auth.register')->middleware('guest')->name('register');
    Route::post('/register', [AuthController::class, 'register']);

    Route::view('/login','auth.login')->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});
