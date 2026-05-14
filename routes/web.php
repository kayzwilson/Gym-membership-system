<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\MembershipPlanController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\WorkoutPlanController;
use App\Http\Controllers\TrainingSessionController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Notifications
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::post('/notifications/{notification}/read', [NotificationController::class, 'markRead'])->name('notifications.read');
    Route::post('/notifications/read-all', [NotificationController::class, 'markAllRead'])->name('notifications.readAll');
    Route::delete('/notifications/{notification}', [NotificationController::class, 'destroy'])->name('notifications.destroy');

    Route::get('/payments/{payment}/invoice', [PaymentController::class, 'invoice'])->name('payments.invoice');

    // Admin only
    Route::middleware(['admin'])->group(function () {
        Route::resource('membership_plans', MembershipPlanController::class);
        Route::resource('payments', PaymentController::class);
        Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    });

    // Admin and Trainer
    Route::middleware(['trainer'])->group(function () {
        Route::resource('members', MemberController::class);
        Route::resource('attendance', AttendanceController::class);
        Route::resource('workout_plans', WorkoutPlanController::class);
        Route::resource('training_sessions', TrainingSessionController::class);
    });

});

require __DIR__.'/auth.php';