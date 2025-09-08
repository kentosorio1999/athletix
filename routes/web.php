<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ControlPanelController;
use App\Http\Controllers\EventController;
// use App\Http\Controllers\SystemSettingsController;


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
    // dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // announcement
    Route::get('/announcements', [AnnouncementController::class, 'index'])->name('announcements');
    Route::post('/announcements', [AnnouncementController::class, 'store'])->name('announcements');

    // control panel
    Route::get('/control-panel', [ControlPanelController::class, 'index'])->name('control.panel');
    
    // Users
    Route::post('/control-panel/user/store', [ControlPanelController::class, 'storeUser'])->name('control-panel.storeUser');
    Route::put('/control-panel/user/{id}/update', [ControlPanelController::class, 'updateUser'])->name('control-panel.updateUser');
    Route::patch('/control-panel/user/{id}/delete', [ControlPanelController::class, 'deleteUser'])->name('control-panel.deleteUser');

    // Teams
    Route::post('/control-panel/team/store', [ControlPanelController::class, 'storeTeam'])->name('control-panel.storeTeam');
    Route::put('/control-panel/team/{id}/update', [ControlPanelController::class, 'updateTeam'])->name('control-panel.updateTeam');
    Route::delete('/control-panel/team/{id}/delete', [ControlPanelController::class, 'deleteTeam'])->name('control-panel.deleteTeam');

    // Departments
    Route::post('/departments/store', [ControlPanelController::class, 'storeDepartment'])->name('departments.store');
    Route::put('/departments/{id}/update', [ControlPanelController::class, 'updateDepartment'])->name('departments.update');
    Route::patch('/departments/{id}/deactivate', [ControlPanelController::class, 'deactivateDepartment'])->name('departments.deactivate');


    // Course
    Route::post('/courses/store', [ControlPanelController::class, 'storeDepartment'])->name('courses.store');
    Route::put('/courses/{id}/update', [ControlPanelController::class, 'updateCourse'])->name('courses.update');
    Route::patch('/courses/{id}/deactivate', [ControlPanelController::class, 'deactivateCourse'])->name('courses.deactivate');

    // Sections
    Route::post('/sections/store', [ControlPanelController::class, 'storeSection'])->name('sections.store');
    Route::put('/sections/{id}/update', [ControlPanelController::class, 'updateSection'])->name('sections.update');
    Route::patch('/sections/{id}/deactivate', [ControlPanelController::class, 'deactivateSection'])->name('sections.deactivate');


    // Event
    Route::get('/events', [EventController::class, 'index'])->name('events');
    Route::post('/events/store', [EventController::class, 'storeEvent'])->name('events.storeEvent');
    Route::put('/events/{id}/update', [EventController::class, 'updateEvent'])->name('events.updateEvent');
    Route::delete('/events/{id}', [EventController::class, 'deleteEvent'])->name('events.deleteEvent');



    // Database
    Route::get('/control-panel/backup', [ControlPanelController::class, 'backupDatabase'])->name('control-panel.backupDatabase');
    // Route::get('/system-settings/audit-logs', [SystemSettingsController::class, 'auditLogs'])->name('system.auditLogs');

    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users', [UserController::class, 'index'])->name('users.index');     // list users
    Route::post('/users', [UserController::class, 'store'])->name('users.store');    // create user
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit'); // edit form
    Route::resource('users', UserController::class)->only(['store', 'update', 'destroy']);
    // Route::get('/control', [UserController::class,'controlPanel'])->name('control');

    Route::get('/performance', fn() => view('performance'))->name('performance');
    // Route::get('/events', fn() => view('events'))->name('events');
    Route::get('/attendance', fn() => view('attendance'))->name('attendance');
    Route::get('/reports', fn() => view('reports'))->name('reports');
    Route::get('/messages', fn() => view('messages'))->name('messages');
    Route::get('/schedule', fn() => view('schedule'))->name('schedule');
    Route::get('/notifications', fn() => view('notifications'))->name('notifications');
    Route::get('/settings', fn() => view('settings'))->name('settings');
    Route::get('/reports/export', [ReportController::class, 'export'])->name('reports.export');
});
