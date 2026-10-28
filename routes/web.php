<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MarketplaceController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\InvoiceController;

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

// Protected shop dashboard and booking management (auth removed as requested)
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard');

Route::get('/dashboard/bookings', [DashboardController::class, 'bookings'])
    ->name('dashboard.bookings');

Route::patch('/dashboard/bookings/{booking}', [DashboardController::class, 'updateBooking'])
    ->name('dashboard.bookings.update');

// Guest cancellation – signed URL for security
Route::get('/booking/{booking}/cancel', [BookingController::class, 'cancel'])
    ->name('marketplace.booking-cancel')
    ->middleware('signed');

// Invoice download (PDF)
Route::get('/booking/{booking}/invoice', [InvoiceController::class, 'download'])
    ->name('marketplace.invoice');
