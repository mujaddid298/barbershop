<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BarberController;
use App\Http\Controllers\Admin\FinanceController;
use App\Http\Controllers\Admin\HasilKaryaController;
use App\Http\Controllers\Admin\LayananController;
use App\Http\Controllers\Admin\PromoController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LiveQueueController;
use App\Http\Controllers\User\BookingController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\UserController as UserUserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

Route::post('/booking/payment-callback', [BookingController::class, 'paymentCallback'])->name('booking.payment-callback');

Route::get('/live-antrian', [LiveQueueController::class, 'index'])->name('live-antrian');

Route::middleware(['auth', 'role:user'])
    ->prefix('user')
    ->name('user.')
    ->group(function () {
        Route::get('/dashboard', [UserUserController::class, 'index'])->name('dashboard');

        Route::get('/booking', [BookingController::class, 'create'])->name('booking.create');
        Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');
        Route::get('/booking/success/{booking}', [BookingController::class, 'success'])->name('booking.success');

        Route::get('/booking/estimate-time', [BookingController::class, 'estimateTime'])->name('booking.estimate-time');
        Route::post('/booking/payment-complete', [BookingController::class, 'paymentComplete'])->name('booking.payment-complete');
        Route::post('/booking/check-promo', [BookingController::class, 'checkPromo'])->name('booking.check-promo');

        Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
        Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');
        Route::delete('/profile/foto', [ProfileController::class, 'deleteFoto'])->name('profile.delete-foto');
        Route::get('/riwayat-booking', [BookingController::class, 'history'])->name('booking.history');
        Route::post('/booking/{booking}/rate', [BookingController::class, 'rate'])->name('booking.rate');
    });

Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
        Route::post('/dashboard/antrian-offline', [AdminController::class, 'storeOffline'])->name('antrian.offline.store');
        Route::post('/dashboard/antrian/{id}/status', [AdminController::class, 'updateQueueStatus'])->name('antrian.update-status');
        Route::get('/riwayat-pemesanan', [AdminController::class, 'bookingHistory'])->name('booking.history');

        Route::get('/keuangan', [FinanceController::class, 'index'])->name('finance.index');
        Route::get('/keuangan/export', [FinanceController::class, 'export'])->name('finance.export');

        Route::get('/data-user', [UserController::class, 'index'])->name('datauser');
        Route::get('/data-user/create', [UserController::class, 'create'])->name('users.create');
        Route::post('/data-user/store', [UserController::class, 'store'])->name('users.store');
        Route::get('/data-user/edit/{user}', [UserController::class, 'edit'])->name('users.edit');
        Route::put('/data-user/update/{user}', [UserController::class, 'update'])->name('users.update');
        Route::delete('/data-user/delete/{user}', [UserController::class, 'destroy'])->name('users.destroy');

        Route::get('/layanan', [LayananController::class, 'index'])->name('layanan');
        Route::get('/layanan/create', [LayananController::class, 'create'])->name('layanan.create');
        Route::post('/layanan/store', [LayananController::class, 'store'])->name('layanan.store');
        Route::get('/layanan/edit/{layanan}', [LayananController::class, 'edit'])->name('layanan.edit');
        Route::put('/layanan/update/{layanan}', [LayananController::class, 'update'])->name('layanan.update');
        Route::delete('/layanan/delete/{layanan}', [LayananController::class, 'destroy'])->name('layanan.destroy');

        Route::get('/barber', [BarberController::class, 'index'])->name('barber');
        Route::get('/barber/create', [BarberController::class, 'create'])->name('barber.create');
        Route::post('/barber/store', [BarberController::class, 'store'])->name('barber.store');
        Route::get('/barber/edit/{barber}', [BarberController::class, 'edit'])->name('barber.edit');
        Route::put('/barber/update/{barber}', [BarberController::class, 'update'])->name('barber.update');
        Route::delete('/barber/delete/{barber}', [BarberController::class, 'destroy'])->name('barber.destroy');

        Route::get('/promo', [PromoController::class, 'index'])->name('promo');
        Route::get('/promo/create', [PromoController::class, 'create'])->name('promo.create');
        Route::post('/promo/store', [PromoController::class, 'store'])->name('promo.store');
        Route::get('/promo/edit/{promo}', [PromoController::class, 'edit'])->name('promo.edit');
        Route::put('/promo/update/{promo}', [PromoController::class, 'update'])->name('promo.update');
        Route::delete('/promo/delete/{promo}', [PromoController::class, 'destroy'])->name('promo.destroy');

        Route::resource('hasil-karya', HasilKaryaController::class)->names([
            'index' => 'hasil-karya.index',
            'create' => 'hasil-karya.create',
            'store' => 'hasil-karya.store',
            'edit' => 'hasil-karya.edit',
            'update' => 'hasil-karya.update',
            'destroy' => 'hasil-karya.destroy',
        ]);
    });
