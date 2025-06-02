<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\ItemInLogController;
use App\Http\Controllers\WithdrawLogController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ReturnLogController;
use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubcategoryController;

// 🔐 Auth (Public)
Route::post('/login', [AuthController::class, 'login']);

// 🔐 Protected Routes (JWT Required)
Route::middleware(['jwt.auth', 'log.activity'])->group(function () {

    // 🔐 Auth - Session Control
    Route::get('/me', [AuthController::class, 'me']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);

    // 📦 Barang Masuk / Keluar
    Route::get('/barang-masuk', [ItemInLogController::class, 'index']);
    Route::post('/barang-masuk', [ItemInLogController::class, 'store']);
    Route::get('/barang-masuk/{id}', [ItemInLogController::class, 'show']);
    Route::put('/barang-masuk/{id}', [ItemInLogController::class, 'update']);
    Route::delete('/barang-masuk/{id}', [ItemInLogController::class, 'destroy']);

    // 📦 Barang Keluar
    Route::get('/barang-keluar', [WithdrawLogController::class, 'index']);
    Route::post('/barang-keluar', [WithdrawLogController::class, 'store']);
    Route::get('/barang-keluar/{id}', [WithdrawLogController::class, 'show']);
    Route::put('/barang-keluar/{id}', [WithdrawLogController::class, 'update']);
    Route::delete('/barang-keluar/{id}', [WithdrawLogController::class, 'destroy']);

    // 🧾 Invoices
    Route::get('/invoices', [InvoiceController::class, 'index']);
    Route::post('/invoices', [InvoiceController::class, 'store']);
    Route::get('/invoices/{id}', [InvoiceController::class, 'show']);
    Route::put('/invoices/{id}', [InvoiceController::class, 'update']);
    Route::delete('/invoices/{id}', [InvoiceController::class, 'destroy']);

    // 🔁 Return Logs
    Route::get('/return-logs', [ReturnLogController::class, 'index']);
    Route::post('/return-logs', [ReturnLogController::class, 'store']);
    Route::get('/return-logs/{id}', [ReturnLogController::class, 'show']);
    Route::put('/return-logs/{id}', [ReturnLogController::class, 'update']);
    Route::delete('/return-logs/{id}', [ReturnLogController::class, 'destroy']);

    // 🛒 Cart
    Route::post('/cart/add', [CartController::class, 'addToCart']);
    Route::get('/cart', [CartController::class, 'viewCart']);
    Route::delete('/cart/remove/{id}', [CartController::class, 'removeFromCart']);
    Route::delete('/cart/clear', [CartController::class, 'clearCart']);

    // 📋 Users (Admin Feature)
    // Route::middleware('auth:api')->group(function () {
    Route::get('/users', [UserController::class, 'index']);
    Route::post('/users', [UserController::class, 'store']);
    Route::get('/users/{id}', [UserController::class, 'show']);
    Route::put('/users/{id}', [UserController::class, 'update']);
    Route::delete('/users/{id}', [UserController::class, 'destroy']);
    // });

    // 📦 Items
    Route::get('/items', [ItemController::class, 'index']);
    Route::post('/items', [ItemController::class, 'store']);
    Route::put('/items/{id}', [ItemController::class, 'update']);
    Route::delete('/items/{id}', [ItemController::class, 'destroy']);

    // 📚 Category
    Route::get('/category', [CategoryController::class, 'index']);
    Route::post('/category', [CategoryController::class, 'store']);
    Route::put('/category/{id}', [CategoryController::class, 'update']);
    Route::delete('/category/{id}', [CategoryController::class, 'destroy']);

    Route::get('/subcategory', [SubcategoryController::class, 'index']);
    Route::post('/subcategory', [SubcategoryController::class, 'store']);
    Route::put('/subcategory/{id}', [SubcategoryController::class, 'update']);
    Route::delete('/subcategory/{id}', [SubcategoryController::class, 'destroy']);

    // 🏢 Suppliers
    Route::get('/suppliers', [SupplierController::class, 'index']);
    Route::post('/suppliers', [SupplierController::class, 'store']);
    Route::put('/suppliers/{id}', [SupplierController::class, 'update']);
    Route::delete('/suppliers/{id}', [SupplierController::class, 'destroy']);

    // 📊 Activity Logs
    Route::get('/activity-logs', [ActivityLogController::class, 'index']);
    Route::post('/activity-logs', [ActivityLogController::class, 'store']);
    Route::get('/activity-logs/{id}', [ActivityLogController::class, 'show']);
});


// 🛡️ Admin-Only Endpoint (JWT + Role Middleware)
Route::middleware(['auth:api', 'role:admin,super_admin'])->get('/admin-area', function () {
    return response()->json(['message' => 'Admin access granted']);
});
