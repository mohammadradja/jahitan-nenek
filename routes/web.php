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

// Locale Switcher
Route::get('/lang/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'id'])) {
        session()->put('locale', $locale);
        session()->save();
    }
    return redirect()->back();
})->name('lang.switch');

Route::get('/feed/instagram', [\App\Http\Controllers\FeedController::class, 'instagram'])->name('feed.instagram');

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
