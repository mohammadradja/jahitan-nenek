<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Superadmin\SiteSettingController;
use App\Http\Controllers\DashboardController;

Route::middleware(['auth', 'role:superadmin'])->prefix('superadmin')->name('superadmin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'superadmin'])->name('dashboard');
    
    // Site Settings & Management
    Route::get('/settings', [SiteSettingController::class, 'index'])->name('settings.index');
    Route::post('/settings', [SiteSettingController::class, 'update'])->name('settings.update');

    // Reports
    Route::get('/reports', function() { return view('dashboards.superadmin.reports'); })->name('reports.index');

    // Staff Management
    Route::get('/staff', function() { return view('dashboards.superadmin.staff'); })->name('staff.index');
});
