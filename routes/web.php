<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookingController;

// Halaman Utama & Booking Form (Public)
Route::get('/', [BookingController::class, 'createForm'])->name('booking.index');
Route::get('/booking', [BookingController::class, 'createForm']); 
Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');
Route::get('/booking/tiket/{id}', [BookingController::class, 'tiket'])->name('booking.tiket');

// API Realtime Status
Route::get('/booking/check-status/{id}', [BookingController::class, 'checkStatus']);

// Route Khusus Admin (Harus Login)
Route::middleware(['auth'])->group(function () {
    // Dashboard Admin (Menggunakan fungsi index yang sudah ada fitur search-nya)
    Route::get('/dashboard', [BookingController::class, 'index'])->name('dashboard');
    
    // Route Profile
    Route::get('/profile', function () {
        return view('profile');
    })->name('admin.profile');

    // Aksi Admin Antrean
    Route::post('/admin/panggil/{id}', [BookingController::class, 'panggil'])->name('admin.panggil');
    Route::post('/admin/dilayani/{id}', [BookingController::class, 'dilayani'])->name('admin.dilayani');
    Route::delete('/admin/destroy/{id}', [BookingController::class, 'destroy'])->name('admin.destroy');
});

require __DIR__.'/auth.php';