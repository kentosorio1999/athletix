<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\UserController;

// ✅ Login page (GET)
Route::get('/', function () {
    return view('welcome'); // your login.blade.php
})->name('login')->middleware('guest'); 
// 👆 important: name it "login" because Laravel's auth middleware redirects to this

// ✅ Register (POST)
Route::post('/register', [AuthController::class, 'register'])->name('register');

// ✅ Login (POST)
Route::post('/login', [AuthController::class, 'login'])->name('login.attempt');

// ✅ Logout
Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect()->route('login');
})->name('logout');

// ✅ OTP Routes
Route::get('/verify-otp/{user_id}', [AuthController::class, 'showOtpPage'])->name('verify.otp.page');
Route::post('/verify-otp', [AuthController::class, 'verifyOtp'])->name('verify.otp');
Route::post('/resend-otp', [AuthController::class, 'resendOtp'])->name('resend.otp');

// ✅ Protected routes
Route::middleware(['auth'])->group(function () {
    Route::get('/announcements', [AnnouncementController::class, 'index'])->name('announcements.index');
    Route::post('/announcements', [AnnouncementController::class, 'store'])->name('announcements.store');

    Route::post('/users', [UserController::class, 'store'])->name('users.store');

    Route::get('/control', fn() => view('controlPanel'))->name('control');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/performance', fn() => view('performance'))->name('performance');
    Route::get('/events', fn() => view('events'))->name('events');
    Route::get('/attendance', fn() => view('attendance'))->name('attendance');
    Route::get('/reports', fn() => view('reports'))->name('reports');
    Route::get('/messages', fn() => view('messages'))->name('messages');
    Route::get('/schedule', fn() => view('schedule'))->name('schedule');
    Route::get('/notifications', fn() => view('notifications'))->name('notifications');
    Route::get('/settings', fn() => view('settings'))->name('settings');
});
