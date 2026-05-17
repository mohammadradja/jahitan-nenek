<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\DashboardController;

Route::middleware(['auth', 'role:admin,superadmin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'admin'])->name('dashboard');
    
    // Resource Management
    Route::resource('products', ProductController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('orders', OrderController::class);
    Route::post('/orders/{order}/approve', [OrderController::class, 'approve'])->name('orders.approve');
    Route::post('/orders/{order}/reject', [OrderController::class, 'reject'])->name('orders.reject');
    Route::post('/orders/{order}/stages', [OrderController::class, 'addStage'])->name('orders.stages.add');
    Route::delete('/stages/{stage}', [OrderController::class, 'deleteStage'])->name('orders.stages.delete');
    Route::resource('measurements', \App\Http\Controllers\Admin\MeasurementController::class);
    Route::resource('blogs', BlogController::class);
    Route::prefix('reports')->name('reports.')->group(function() {
        Route::get('/sales', [\App\Http\Controllers\Admin\ReportController::class, 'sales'])->name('sales');
        Route::get('/stock', [\App\Http\Controllers\Admin\ReportController::class, 'stock'])->name('stock');
        Route::get('/customers', [\App\Http\Controllers\Admin\ReportController::class, 'customers'])->name('customers');
        Route::get('/finance', [\App\Http\Controllers\Admin\ReportController::class, 'finance'])->name('finance');
    });

    // Site Settings (CMS)
    Route::get('/settings', [\App\Http\Controllers\Superadmin\SiteSettingController::class, 'index'])->name('settings.index');
    Route::post('/settings', [\App\Http\Controllers\Superadmin\SiteSettingController::class, 'update'])->name('settings.update');
    Route::post('/settings/test-connection', [\App\Http\Controllers\Superadmin\SiteSettingController::class, 'testConnection'])->name('settings.test');

    // Dedicated Content Management System (CMS)
    Route::get('/cms', [\App\Http\Controllers\CMSController::class, 'index'])->name('cms.index');
    Route::post('/cms', [\App\Http\Controllers\CMSController::class, 'update'])->name('cms.update');
});
