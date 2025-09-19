<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BookingController;

Route::get('/', [UserController::class, 'index'])->name('index');
Route::post('/register', [UserController::class, 'register'])->name('register');
Route::post('/login', [UserController::class, 'login'])->name('login');
Route::get('/logout', [UserController::class, 'logout'])->name('logout');

Route::get('/booking', [BookingController::class, 'create'])->name('booking');
Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');

Route::middleware(['auth'])->group(function () {
    Route::get('/riwayat', [BookingController::class, 'riwayat'])->name('riwayat');
});
