<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarController;
use App\Http\Controllers\BookingController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/cars', [CarController::class, 'index'])->name('cars.index');
    Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');
    Route::get('/bookings', [BookingController::class, 'index'])->name('bookings.index');
    
    // Admin Routes - Simplified approach
    Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
        // Dashboard
        Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
        
        // Cars Management
        Route::get('/cars', [AdminController::class, 'cars'])->name('cars');
        Route::get('/cars/create', [AdminController::class, 'createCar'])->name('cars.create');
        Route::post('/cars', [AdminController::class, 'storeCar'])->name('cars.store');
        Route::get('/cars/{car}/edit', [AdminController::class, 'editCar'])->name('cars.edit');
        Route::patch('/cars/{car}', [AdminController::class, 'updateCar'])->name('cars.update');
        Route::delete('/cars/{car}', [AdminController::class, 'deleteCar'])->name('cars.delete');
        
        // Bookings Management
        Route::get('/bookings', [AdminController::class, 'bookings'])->name('bookings');
        Route::get('/bookings/{booking}', [AdminController::class, 'showBooking'])->name('bookings.show');
        Route::patch('/bookings/{booking}/status', [AdminController::class, 'updateBookingStatus'])->name('bookings.update-status');
        
        // Staff Management (admin only)
        Route::get('/staff', [AdminController::class, 'staff'])->name('staff');
        Route::get('/staff/create', [AdminController::class, 'createStaff'])->name('staff.create');
        Route::post('/staff', [AdminController::class, 'storeStaff'])->name('staff.store');
        Route::get('/staff/{user}/edit', [AdminController::class, 'editStaff'])->name('staff.edit');
        Route::patch('/staff/{user}', [AdminController::class, 'updateStaff'])->name('staff.update');
        Route::delete('/staff/{user}', [AdminController::class, 'deleteStaff'])->name('staff.delete');
    });
});

require __DIR__.'/auth.php';