<?php

use App\Http\Controllers\AuthController\MasukController;
use App\Http\Controllers\AuthController\AuthController;
use App\Http\Controllers\AuthController\LogoutController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController\SandiController;
use App\Http\Controllers\AuthController\PendaftaranController;

Route::get('/', [MasukController::class, 'login'])->name('login');
Route::post('/public/login-proses', [MasukController::class, 'login_proses'])->name('login-proses');

Route::middleware(['web'])->group(function () {
    Route::get('auth/google', [AuthController::class, 'redirectToGoogle'])->name('login.google');
    Route::get('auth/google/callback', [AuthController::class, 'handleGoogleCallback']);
    Route::get('/auth/facebook', [AuthController::class, 'redirectToFacebook'])->name('login.facebook');
    Route::get('/auth/facebook/callback', [AuthController::class, 'handleFacebookCallback']);
});

Route::get('/verify-email', [PendaftaranController::class, 'verifyEmail'])->name('verification.verify');

Route::get('/forgot-password', [SandiController::class, 'forgot_password'])->name('forgot-password');
Route::post('/forgot-password-act', [SandiController::class, 'forgot_password_act'])->name('forgot-password-act');

Route::get('/validasi-forgot-password/{token}/{email}', [SandiController::class, 'validasi_forgot_password'])->name('validasi-forgot-password');
Route::post('/validasi-forgot-password-act/{email}', [SandiController::class, 'validasi_forgot_password_act'])->name('validasi-forgot-password-act');

Route::get('/register', [PendaftaranController::class, 'showRegistrationForm'])->name('register');
Route::post('/register-proses', [PendaftaranController::class, 'register'])->name('register-proses');

Route::post('/admin/logout', [LogoutController::class, 'logout'])->name('logout');

require __DIR__.'/admin.php';
require __DIR__.'/user.php';



