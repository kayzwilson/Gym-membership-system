<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\MembershipPlanController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware(['auth'])->group(function () {

    // Dashboard - all roles
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    // Profile - all roles
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

    // Admin only
    Route::middleware(['admin'])->group(function () {
        Route::resource('membership_plans', MembershipPlanController::class);
        Route::resource('payments', PaymentController::class);
    });

    // Admin and Staff
    Route::middleware(['staff'])->group(function () {
        Route::resource('members', MemberController::class);
        Route::resource('attendance', AttendanceController::class);
    });

});

require __DIR__.'/auth.php';