<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\Admin\DataController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\HistoryController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\User\UserDashboardController;
use App\Http\Controllers\User\HewanController;
use App\Http\Controllers\User\UserBookingController;
use App\Http\Controllers\User\FrontendFaqController;
use App\Http\Controllers\User\NotificationController;
use App\Http\Controllers\User\UserSettingController;


// root → login
Route::get('/', [AuthController::class, 'index']);

// login page (GET)
Route::get('/login', [AuthController::class, 'index'])->name('login');
// proses login (POST)
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

// register (konsumen)
Route::get('/register', function () {
    return view('auth.register');
});
Route::post('/register', [AuthController::class, 'register']);

//Dashboard admin
Route::middleware('auth:admin')->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'index']);
});

//Dashboard user
Route::middleware(['auth'])->group(function () {
    Route::get('/user/dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');
});

//card atas didashboard halaman admin
// Booking Baru
Route::get('/admin/booking', [BookingController::class, 'booking'])->name('booking.booking');

// Booking ke Process
Route::post('/admin/booking/toProcess/{id}', [BookingController::class, 'toProcess'])->name('booking.toProcess');

// Booking ke Cancel
Route::post('/admin/booking/cancel/{id}', [BookingController::class, 'cancel'])->name('booking.cancel');

// ================== Process ==================

// Halaman Process
Route::get('/admin/booking/process', [BookingController::class, 'process'])->name('booking.process');

// Process ke Done
Route::post('/admin/booking/toDone/{id}', [BookingController::class, 'toDone'])->name('booking.toDone');


// Halaman Done
Route::get('/admin/booking/done',[BookingController::class, 'done'])->name('booking.doneList');

// Konfirmasi
Route::post('/admin/booking/done/{id}/confirm',[BookingController::class, 'confirm'])->name('booking.confirm');


// Konfirmasi pengambilan masuk History
Route::post('/admin/booking/done/{id}/confirm',[BookingController::class, 'confirm'])->name('booking.confirm');
//data
Route::prefix('admin/data')->group(function () {
    //karyawan
    Route::get('/karyawan', [DataController::class, 'karyawan'])->name('karyawan.index');
    Route::get('/karyawan/create', [DataController::class, 'createKaryawan'])->name('karyawan.create');
    Route::post('/karyawan', [DataController::class, 'storeKaryawan'])->name('karyawan.store');
    Route::get('/karyawan/{id}/edit', [DataController::class, 'editKaryawan'])->name('karyawan.edit');
    Route::put('/karyawan/{id}', [DataController::class, 'updateKaryawan'])->name('karyawan.update');
    Route::delete('/karyawan/{id}', [DataController::class, 'deleteKaryawan'])->name('karyawan.destroy');

    // Hewan
    Route::get('/hewan', [DataController::class, 'hewan'])->name('admin.hewan');

    // Pelayanan
    Route::get('/pelayanan', [DataController::class, 'pelayanan'])->name('pelayanan.index');
    Route::get('/pelayanan/create', [DataController::class, 'createPelayanan'])->name('pelayanan.create');
    Route::post('/pelayanan', [DataController::class, 'storePelayanan'])->name('pelayanan.store');
    Route::get('/pelayanan/{id}/edit', [DataController::class, 'editPelayanan'])->name('pelayanan.edit');
    Route::put('/pelayanan/{id}', [DataController::class, 'updatePelayanan'])->name('pelayanan.update');
    Route::delete('/pelayanan/{id}', [DataController::class, 'deletePelayanan'])->name('pelayanan.destroy');
});

// History
Route::get('/admin/history', [HistoryController::class, 'index'])->name('history.booking');

// FAQ
Route::middleware('auth:admin')->group(function () {
    Route::get('/admin/faq', [FaqController::class, 'index'])->name('admin.faq');
    Route::post('/faq/reply/{id}', [FaqController::class, 'reply'])->name('faq.reply');
});

// Tambah Hewan User
Route::middleware('auth')->group(function () {
    Route::get('/user/hewan/create/{jenis}', [HewanController::class, 'create'])->name('user.hewan.create');
    Route::post('/user/hewan/store', [HewanController::class, 'store'])->name('user.hewan.store');
    Route::get('/user/hewan/{hewan}/edit', [HewanController::class, 'edit'])->name('hewan.edit');
    Route::put('/user/hewan/{hewan}', [HewanController::class, 'update'])->name('hewan.update');
    Route::delete('/user/hewan/{hewan}', [HewanController::class, 'destroy'])->name('hewan.destroy');
});

//Tambah Booking di user
Route::middleware('auth')->group(function () {
    Route::get('/user/booking/create/{hewan}', [UserBookingController::class, 'create'])->name('booking.create');
    Route::post('/user/booking/store', [UserBookingController::class, 'store'])->name('booking.store');
});


// FAQ User
Route::middleware('auth')->group(function() {
    Route::get('/user/faq', [FrontendFaqController::class, 'index'])->name('faq.index');
    Route::post('/user/faq', [FrontendFaqController::class, 'store'])->name('faq.store');
});

// notifikasi user
Route::prefix('user')->middleware('auth')->group(function() {
    Route::get('/notifications', [NotificationController::class, 'index'])->name('user.notifications');
    Route::get('/notifications/read/{id}', [NotificationController::class, 'markAsRead'])->name('user.notifications.read');
});


// Setting akun admin
Route::middleware('auth:admin')->group(function () {
    Route::get('/admin/setting', [SettingController::class, 'index'])->name('admin.setting');
    Route::post('/setting/profile', [SettingController::class, 'updateProfile'])->name('setting.profile');
    Route::post('/setting/password', [SettingController::class, 'updatePassword'])->name('setting.password');
});

// Setting di akun user

Route::prefix('user')->middleware('auth')->group(function()  {
    Route::get('/setting', [UserSettingController::class, 'index'])->name('user.setting');
    Route::post('/setting/photo', [UserSettingController::class, 'updatePhoto'])->name('user.setting.photo');
    Route::post('/setting/info', [UserSettingController::class, 'updateInfo'])->name('user.setting.info');
    Route::post('/setting/password', [UserSettingController::class, 'updatePassword'])->name('user.setting.password');
});

// logout
Route::post('/logout', [AuthController::class, 'logout']);
