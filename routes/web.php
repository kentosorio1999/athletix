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
use App\Http\Controllers\SecurityController;
use App\Http\Controllers\PerformanceController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\StaffProfileController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\RegistrationApprovalController;
use App\Http\Controllers\AthleteController;
use App\Http\Controllers\StaffNotificationController;


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
    Route::middleware(['auth', 'role:SuperAdmin|Coach|Staff'])->group(function() {
        // dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        
        // Settings
        Route::get('/settings', [StaffController::class, 'settings'])->name('settings');

        //reports
        Route::get('/reports', [ReportController::class, 'index'])->name('reports');
        Route::get('/reports/export/{format}', [App\Http\Controllers\ReportController::class, 'export'])->name('reports.export');
        Route::get('/reports/export-pdf', [ReportController::class, 'exportPDF'])->name('reports.exportPDF');

    });

    Route::middleware(['auth', 'role:SuperAdmin'])->group(function() {
        
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
        

        // security protocol
        Route::prefix('security')->middleware('auth')->group(function() {
            Route::get('/', [SecurityController::class, 'index'])->name('security.index');
            Route::post('/force-reset/{user}', [SecurityController::class, 'forceReset'])->name('security.forceReset');
            Route::post('/deactivate/{user}', [SecurityController::class, 'deactivateUser'])->name('security.deactivateUser');
            Route::post('/activate/{user}', [SecurityController::class, 'activateUser'])->name('security.activateUser');
            Route::get('/download-logs', [SecurityController::class, 'downloadLogs'])->name('security.downloadLogs');
        });

        // performance
        Route::prefix('performance')->middleware('auth')->group(function() {
            Route::get('/', [PerformanceController::class, 'index'])->name('performance.index'); // <- this is the correct name
            Route::get('/create', [PerformanceController::class, 'create'])->name('performance.create');
            Route::post('/store', [PerformanceController::class, 'store'])->name('performance.store');
            Route::get('/edit/{performance}', [PerformanceController::class, 'edit'])->name('performance.edit');
            Route::post('/update/{performance}', [PerformanceController::class, 'update'])->name('performance.update');
            Route::post('/delete/{performance}', [PerformanceController::class, 'destroy'])->name('performance.destroy');
        });


        // attendance
        Route::prefix('attendance')->middleware('auth')->group(function() {
            Route::get('/', [AttendanceController::class, 'index'])->name('attendance');
            Route::get('/create', [AttendanceController::class, 'create'])->name('attendance.create');
            Route::post('/store', [AttendanceController::class, 'store'])->name('attendance.store');
            Route::get('/edit/{attendance}', [AttendanceController::class, 'edit'])->name('attendance.edit');
            Route::post('/update/{attendance}', [AttendanceController::class, 'update'])->name('attendance.update');
            Route::post('/delete/{attendance}', [AttendanceController::class, 'destroy'])->name('attendance.destroy');
        });

        //notifications
        Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
        Route::get('/notifications/mark-as-read/{id}', [NotificationController::class, 'markAsRead'])->name('notifications.markAsRead');
        Route::post('/notifications', [NotificationController::class, 'store'])->name('notifications.store');

        Route::post('/users', [UserController::class, 'store'])->name('users.store');
        Route::get('/users', [UserController::class, 'index'])->name('users.index');     // list users
        Route::post('/users', [UserController::class, 'store'])->name('users.store');    // create user
        Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit'); // edit form
        Route::resource('users', UserController::class)->only(['store', 'update', 'destroy']);

    });

     Route::middleware(['auth', 'role:Staff'])->group(function() {

        Route::prefix('staff')->name('staff.')->group(function () {
            Route::get('/announcements', [AnnouncementController::class, 'index'])->name('announcements.index');
            // Route::get('/athlete/deactivate', [RegistrationController::class, 'approval'])->name('athlete.deactivate');
            // Route::get('/athlete/update', [RegistrationController::class, 'approval'])->name('athlete.update');
            
            // Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
            // Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');

            //registration
            Route::get('/registration-approval', [RegistrationApprovalController::class, 'index'])
                ->name('approval.index');
            Route::patch('/registration-approval/{id}/approve', [RegistrationApprovalController::class, 'approve'])
                ->name('approval.approve');
            Route::patch('/registration-approval/{id}/reject', [RegistrationApprovalController::class, 'reject'])
                ->name('approval.reject');

            // Athlete Deactivation
            Route::get('/athlete/deactivate', [AthleteController::class, 'deactivateIndex'])
                ->name('athlete.deactivate');
            Route::patch('/athlete/deactivate/{id}', [AthleteController::class, 'deactivate'])
                ->name('athlete.deactivate.submit');

            // Athlete update
            // ✅ Athlete Update (manage athletes by staff)
            Route::get('/athletes', [AthleteController::class, 'index'])->name('athletes.index');
            Route::patch('/athletes/{id}', [AthleteController::class, 'update'])->name('athletes.update');

            // ✅ Staff Profile Update (staff managing their own profile)
            Route::get('/profile', [StaffProfileController::class, 'edit'])->name('profile.edit');
            Route::patch('/profile', [StaffProfileController::class, 'update'])->name('profile.update');
        
            // Notifications
            Route::get('/notifications', [StaffNotificationController::class, 'index'])
                ->name('notifications.index');
            Route::post('/notifications/{id}/read', [StaffNotificationController::class, 'markAsRead'])
                ->name('notifications.read');
        });

     });

    //Route::get('/notifications', fn() => view('notifications'))->name('notifications');
    // Route::get('/settings', fn() => view('settings'))->name('settings');

});
