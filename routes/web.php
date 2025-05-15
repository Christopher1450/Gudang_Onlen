<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ItemInLogController;
use App\Http\Controllers\WithdrawLogController;
use App\Http\Controllers\ActivityLogController;


Route::get('/', function () {
    return view('welcome');
});

// Login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.attempt');

// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/user/dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');
});


// Role Management
Route::middleware(['auth', 'superadmin'])->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::patch('/users/{user}/toggle-role', [UserController::class, 'toggleRole'])->name('users.toggleRole');
});


Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

Route::get('/stock', function () {
    return view('stock');
})->middleware(['auth'])->name('stock');

Route::middleware(['auth'])->group(function () {
    Route::get('/items', [ItemInLogController::class, 'index'])->name('items.index');
    Route::get('/items/create', [ItemInLogController::class, 'create'])->name('items.create');
    Route::post('/items', [ItemInLogController::class, 'store'])->name('items.store');
});

    // History Log Doing
Route::middleware(['auth'])->group(function () {
    Route::get('/activity', [ActivityLogController::class, 'index'])->name('activity.index');
});
Route::get('/activity/export', [ActivityLogController::class, 'export'])->name('activity.export');


Route::middleware(['auth'])->group(function () {
    Route::get('/withdraw', [WithdrawLogController::class, 'index'])->name('withdraw.index');
    Route::get('/withdraw/create', [WithdrawLogController::class, 'create'])->name('withdraw.create');
    Route::post('/withdraw', [WithdrawLogController::class, 'store'])->name('withdraw.store');
});
