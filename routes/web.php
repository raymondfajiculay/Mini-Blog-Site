<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PostController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Route;

Route::redirect('/', 'posts');

// Post Routes
Route::resource('posts', PostController::class);

// User Route
Route::get('/{user}/posts', [DashboardController::class, 'userPosts'])->name('posts.user');

// Authenticated User Routes
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class,'index'])->middleware('verified')->name('dashboard');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Email Verification Notice Route
    Route::get('/email/verify', [AuthController::class, 'verifyNotice'])->name('verification.notice');

    // Email Verification Handler Route
    Route::get('/email/verify/{id}/{hash}', [AuthController::class, 'verifyEmail'])->middleware('signed')->name('verification.verify');

    // Resending the Verification Email Route
    Route::post('/email/verification-notification', [AuthController::class, 'verifyHandler'])->middleware('throttle:6,1')->name('verification.send');
});

// Guest User Routes
Route::middleware('guest')->group(function () {
    Route::view('/register','auth.register')->middleware('guest')->name('register');
    Route::post('/register', [AuthController::class, 'register']);

    Route::view('/login','auth.login')->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});
