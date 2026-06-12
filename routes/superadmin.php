<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Superadmin\SiteSettingController;
use App\Http\Controllers\DashboardController;

Route::middleware(['auth', 'role:superadmin'])->prefix('superadmin')->name('superadmin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'superadmin'])->name('dashboard');
    
    // Site Settings & Management
    Route::get('/settings', [SiteSettingController::class, 'index'])->name('settings.index');
    Route::post('/settings', [SiteSettingController::class, 'update'])->name('settings.update');
    Route::post('/settings/test-connection', [SiteSettingController::class, 'testConnection'])->name('settings.test');
    Route::get('/promo', [SiteSettingController::class, 'promo'])->name('promo.index');
    Route::post('/promo', [SiteSettingController::class, 'updatePromo'])->name('promo.update');

    // Dedicated Content Management System (CMS)
    Route::get('/cms', [\App\Http\Controllers\CMSController::class, 'index'])->name('cms.index');
    Route::post('/cms', [\App\Http\Controllers\CMSController::class, 'update'])->name('cms.update');

    // Reports
    Route::prefix('reports')->name('reports.')->group(function() {
        Route::get('/sales', [\App\Http\Controllers\Admin\ReportController::class, 'sales'])->name('sales');
        Route::get('/stock', [\App\Http\Controllers\Admin\ReportController::class, 'stock'])->name('stock');
        Route::get('/customers', [\App\Http\Controllers\Admin\ReportController::class, 'customers'])->name('customers');
        Route::get('/finance', [\App\Http\Controllers\Admin\ReportController::class, 'finance'])->name('finance');
    });

    // Staff Management
    Route::resource('staff', \App\Http\Controllers\Superadmin\StaffController::class)->except(['create', 'show', 'edit']);

    // Customer Management
    Route::get('/customers', [\App\Http\Controllers\Superadmin\CustomerController::class, 'index'])->name('customers.index');
});
