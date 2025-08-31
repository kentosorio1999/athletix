<?php

use Illuminate\Support\Facades\Route;

// routes/web.php
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome');
});


Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/register', [AuthController::class, 'register'])->name('register');


Route::get('/verify-otp/{user_id}', [AuthController::class, 'showOtpPage'])->name('verify.otp.page');
Route::post('/verify-otp', [AuthController::class, 'verifyOtp'])->name('verify.otp');
Route::post('/resend-otp', [AuthController::class, 'resendOtp'])->name('resend.otp');



// Route for announcement page
Route::get('/announcement', function () {
    return view('announcement');
})->name('announcement');

Route::get('/control', function () {
    return view('controlPanel');
})->name('control');



// athlete route
Route::get('/dashboard', function () {
    return view('athlete.dashboard');
})->name('dashboard');