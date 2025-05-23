<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemInLogController;
use App\Http\Controllers\WithdrawLogController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\RoleMiddleware;


Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:api')->group(function () {
Route::get('/me', [AuthController::class, 'me']);
Route::post('/logout', [AuthController::class, 'logout']);
Route::post('/refresh', [AuthController::class, 'refresh']);
});

// Admin
Route::middleware(['auth:api', 'role:admin,super_admin'])->get('/admin-area', function () {
    return response()->json(['message' => 'Admin access granted']);
});


Route::post('/barang-masuk', [ItemInLogController::class, 'store'])->name('barang-masuk.store');
Route::post('/barang-masuk', function (Request $request) {
    try {
        app(ItemInLogController::class)->store($request);
        return response()->json(['message' => 'Barang masuk berhasil dicatat'], 201);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Gagal mencatat barang masuk', 'details' => $e->getMessage()], 500);
    }
});

Route::post('/barang-keluar', function (Request $request) {
    try {
        app(WithdrawLogController::class)->store($request);
        return response()->json(['message' => 'Barang keluar berhasil dicatat'], 201);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Gagal mencatat barang keluar', 'details' => $e->getMessage()], 500);
    }
});
Route::post('/barang-keluar', [WithdrawLogController::class, 'store'])->name('barang-keluar.store');


// Keranjang
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/cart/add', [CartController::class, 'addToCart']);
    Route::get('/cart', [CartController::class, 'viewCart']);
    Route::delete('/cart/remove/{id}', [CartController::class, 'removeFromCart']);
    Route::delete('/cart/clear', [CartController::class, 'clearCart']);
});
