<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ProfileController; // <-- Tambahkan baris ini di atas

// Halaman Utama & Booking Form (Public)
Route::get('/', [BookingController::class, 'createForm'])->name('booking.index');
Route::get('/booking', [BookingController::class, 'createForm']); 
Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');
Route::get('/booking/tiket/{id}', [BookingController::class, 'tiket'])->name('booking.tiket');

// API Realtime Status
Route::get('/booking/check-status/{id}', [BookingController::class, 'checkStatus']);

// Route Khusus Admin (Harus Login)
Route::middleware(['auth'])->group(function () {
    // Dashboard Admin
    Route::get('/dashboard', [BookingController::class, 'index'])->name('dashboard');
    
    // Halaman Laporan
    Route::get('/admin/laporan', [BookingController::class, 'laporan'])->name('admin.laporan');
    
    // Route Profile & Update Profile (CRUD)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('admin.profile');
    Route::put('/profile', [ProfileController::class, 'update'])->name('admin.profile.update');

    // Aksi Admin Antrean
    Route::post('/admin/panggil/{id}', [BookingController::class, 'panggil'])->name('admin.panggil');
    Route::post('/admin/dilayani/{id}', [BookingController::class, 'dilayani'])->name('admin.dilayani');
    Route::delete('/admin/destroy/{id}', [BookingController::class, 'destroy'])->name('admin.destroy');
});

require __DIR__.'/auth.php';