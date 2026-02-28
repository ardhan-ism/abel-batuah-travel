<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

use App\Http\Controllers\Public\AvailabilityController;
use App\Http\Controllers\Public\BookingController;
use App\Http\Controllers\Public\BookingStatusController;

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\RouteController as AdminRouteController;
use App\Http\Controllers\Admin\DriverController as AdminDriverController;
use App\Http\Controllers\Admin\ScheduleController as AdminScheduleController;
use App\Http\Controllers\Admin\BookingController as AdminBookingController;
use App\Http\Controllers\Admin\ReportController;

/*
|--------------------------------------------------------------------------
| PUBLIC (Tanpa Login)
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('public.home');
})->name('home');

Route::prefix('public')->group(function () {
    // Informasi layanan
    Route::view('/services', 'public.services')->name('public.services');

    // Cek ketersediaan (Tahap 4)
    Route::get('/cek-ketersediaan', [AvailabilityController::class, 'index'])->name('public.availability');
    Route::get('/destinations', [AvailabilityController::class, 'destinations'])->name('public.destinations');
    Route::get('/search', [AvailabilityController::class, 'search'])->name('public.search');

    // Booking (Tahap 5)
    Route::get('/booking', [BookingController::class, 'create'])->name('public.booking.create');
    Route::post('/booking', [BookingController::class, 'store'])->name('public.booking.store');
    Route::get('/booking/success', [BookingController::class, 'success'])->name('public.booking.success');

    // Cek status & cancel (Tahap 6)
    Route::get('/status', [BookingStatusController::class, 'form'])->name('public.booking.status.form');
    Route::get('/status/show', [BookingStatusController::class, 'show'])->name('public.booking.status.show');
    Route::post('/status/cancel', [BookingStatusController::class, 'cancel'])->name('public.booking.status.cancel');
});

/*
|--------------------------------------------------------------------------
| AUTH (Breeze)
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Profile bawaan Breeze (optional, boleh dipakai admin)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| ADMIN PANEL (Wajib Login + Role Admin)
|--------------------------------------------------------------------------
*/
Route::prefix('admin')
    ->middleware(['auth', 'admin'])
    ->group(function () {

        // Dashboard admin
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

        // Master data
        Route::resource('/routes', AdminRouteController::class)->names('admin.routes');
        Route::resource('/drivers', AdminDriverController::class)->names('admin.drivers');
        Route::resource('/schedules', AdminScheduleController::class)->names('admin.schedules');

        // Booking management
        Route::get('/bookings', [AdminBookingController::class, 'index'])->name('admin.bookings.index');
        Route::get('/bookings/{booking}', [AdminBookingController::class, 'show'])->name('admin.bookings.show');
        Route::post('/bookings/{booking}/status', [AdminBookingController::class, 'updateStatus'])->name('admin.bookings.status');

        // Reports (Tahap 8) - pindah ke /admin/reports agar konsisten
        Route::get('/reports', [ReportController::class, 'index'])->name('admin.reports.index');
        Route::get('/reports/excel', [ReportController::class, 'exportExcel'])->name('admin.reports.excel');

        // Kalau PDF belum kamu implement, komentari dulu biar tidak error route:
        Route::get('/reports/pdf', [ReportController::class, 'exportPdf'])->name('admin.reports.pdf');
    });
Route::post('/schedules/{schedule}/decision', [AdminScheduleController::class, 'decision'])
    ->name('admin.schedules.decision');
    Route::post('/schedules/{schedule}/decision', [AdminScheduleController::class, 'decision'])
    ->name('admin.schedules.decision');
require __DIR__ . '/auth.php';