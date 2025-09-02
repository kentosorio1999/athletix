<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController; // ✅ Add this

Route::get('/', function () {
    return view('welcome');
});

Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::get('/verify-otp/{user_id}', [AuthController::class, 'showOtpPage'])->name('verify.otp.page');
Route::post('/verify-otp', [AuthController::class, 'verifyOtp'])->name('verify.otp');
Route::post('/resend-otp', [AuthController::class, 'resendOtp'])->name('resend.otp');

// Sidebar routes
Route::get('/announcement', fn() => view('announcement'))->name('announcement');
Route::get('/control', fn() => view('controlPanel'))->name('control');

// ✅ Use only the controller version
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/performance', fn() => view('performance'))->name('performance');
Route::get('/events', fn() => view('events'))->name('events');
Route::get('/attendance', fn() => view('attendance'))->name('attendance');
Route::get('/reports', fn() => view('reports'))->name('reports');
Route::get('/messages', fn() => view('messages'))->name('messages');
Route::get('/schedule', fn() => view('schedule'))->name('schedule');
Route::get('/notifications', fn() => view('notifications'))->name('notifications');
Route::get('/settings', fn() => view('settings'))->name('settings');
