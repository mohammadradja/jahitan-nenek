<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CheckoutController;
use Illuminate\Support\Facades\Route;

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', function () { return view('about'); })->name('about');
Route::get('/contact', function () { return view('contact'); })->name('contact');
Route::get('/product/{slug}', [HomeController::class, 'show'])->name('product.show');

Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');

Route::get('/track-order', [CheckoutController::class, 'track'])->name('order.track');
Route::post('/track-order', [CheckoutController::class, 'trackOrder'])->name('order.track.post');
Route::post('/payments/midtrans-notification', [CheckoutController::class, 'notification'])->name('payments.midtrans-notification');

// Shipping (RajaOngkir)
Route::get('/shipping/provinces', [CheckoutController::class, 'getProvinces'])->name('shipping.provinces');
Route::get('/shipping/cities/{province_id}', [CheckoutController::class, 'getCities'])->name('shipping.cities');
Route::post('/shipping/cost', [CheckoutController::class, 'getCost'])->name('shipping.cost');

// Dashboard redirect based on role
Route::get('/dashboard', function () {
    $user = auth()->user();
    if ($user->role === 'superadmin') {
        return redirect()->route('superadmin.dashboard');
    } elseif ($user->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }
    return redirect()->route('user.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Load Modular Routes
require __DIR__.'/customer.php';
require __DIR__.'/admin.php';
require __DIR__.'/superadmin.php';

require __DIR__.'/auth.php';
