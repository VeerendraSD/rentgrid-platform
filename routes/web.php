<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MarketplaceController;
use App\Http\Controllers\BookingController;

// Public marketplace
Route::get('/', [MarketplaceController::class, 'index'])
    ->name('marketplace.index');

Route::get('/equipment/{item}', [MarketplaceController::class, 'show'])
    ->name('marketplace.show');

// Booking submission and confirmation
Route::post('/equipment/{item}/book', [BookingController::class, 'store'])
    ->name('marketplace.book');

Route::get('/booking/{booking}/success', [BookingController::class, 'success'])
    ->name('marketplace.booking-success');

// Protected dashboard
Route::middleware(['auth', 'role:owner,staff'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

require __DIR__.'/auth.php';
