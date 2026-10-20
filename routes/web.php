<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookingController;

// Halaman Utama / Form Booking Pasien (Public)
Route::get('/', [BookingController::class, 'index'])->name('booking.index');
Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');
Route::get('/booking/tiket/{id}', [BookingController::class, 'tiket'])->name('booking.tiket');

// API Realtime Cek Status Antrean
Route::get('/booking/check-status/{id}', [BookingController::class, 'checkStatus']);

// Route Khusus Admin (Harus Login)
Route::middleware(['auth', 'verified'])->group(function () {
    
    // Dashboard Admin
    Route::get('/dashboard', [BookingController::class, 'dashboard'])->name('dashboard');

    // Profil Admin
    Route::get('/profile', function () {
        return view('profile');
    })->name('admin.profile');

    // Aksi Admin pada Antrean
    Route::post('/admin/panggil/{id}', [BookingController::class, 'panggil'])->name('admin.panggil');
    Route::post('/admin/dilayani/{id}', [BookingController::class, 'dilayani'])->name('admin.dilayani');
    Route::delete('/admin/destroy/{id}', [BookingController::class, 'destroy'])->name('admin.destroy');

});

require __DIR__.'/auth.php';