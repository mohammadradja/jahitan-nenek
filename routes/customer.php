<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DashboardController;

Route::middleware(['auth', 'role:user,admin,superadmin'])->group(function () {
    Route::get('/user/dashboard', [DashboardController::class, 'user'])->name('user.dashboard');
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/buy-now/{product}', [CartController::class, 'buyNow'])->name('cart.buy-now');
    Route::patch('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');

    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'process'])->name('checkout.process');
    Route::get('/checkout/payment/{order}', [CheckoutController::class, 'payment'])->name('checkout.payment');
    Route::post('/checkout/payment/{order}/proof', [CheckoutController::class, 'uploadPaymentProof'])->name('checkout.upload-payment-proof');
    Route::get('/checkout/success/{order}', [CheckoutController::class, 'success'])->name('checkout.success');
});

Route::middleware(['auth', 'role:user,admin,superadmin'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/profile/verify-password', [ProfileController::class, 'verifyPassword'])->name('profile.verify-password');
});
