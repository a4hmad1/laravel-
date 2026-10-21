<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

// Redirect root to dashboard or login
Route::get('/', function () {
    return auth()->check() ? redirect()->route('dashboard') : redirect()->route('login');
});

// Guest Routes
Route::middleware('guest')->group(function () {
    // Login
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

    // Registration with WhatsApp verification
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
    Route::get('/register/verify', [AuthController::class, 'showRegisterVerify'])->name('register.verify');
    Route::post('/register/verify', [AuthController::class, 'verifyRegisterOtp'])->name('register.verify.submit');
    Route::post('/register/resend', [AuthController::class, 'resendRegisterOtp'])->name('register.resend');

    // Forgot Password with WhatsApp OTP
    Route::get('/forgot-password', [AuthController::class, 'showForgotPassword'])->name('password.request');
    Route::post('/forgot-password', [AuthController::class, 'sendResetOtp'])->name('password.phone');
    Route::get('/reset-password', [AuthController::class, 'showResetPasswordVerify'])->name('password.verify');
    Route::post('/reset-password', [AuthController::class, 'verifyAndResetPassword'])->name('password.update');
    Route::post('/reset-password/resend', [AuthController::class, 'resendResetOtp'])->name('password.resend');
});

// Authenticated Routes
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
