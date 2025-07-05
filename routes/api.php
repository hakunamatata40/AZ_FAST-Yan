<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\MerchantController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CourierController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\KYCController;
use App\Http\Controllers\WalletController;
use App\Http\Controllers\StorefrontController;
use App\Http\Controllers\SupportController;
use App\Http\Controllers\ProfileController;

// ORDERS
Route::get('/orders/{id}', [OrderController::class, 'show']);
Route::get('/orders/{id}/track', [OrderController::class, 'track']);
Route::post('/orders/{id}/cancel', [OrderController::class, 'cancelOrder']);
Route::post('/orders', [OrderController::class, 'store']);
Route::post('/verify-code/{orderId}', [OrderController::class, 'verifyCode']);

// DELIVERY
Route::post('/courier/orders/{id}/start', [OrderController::class, 'startDelivery']);
Route::post('/courier/orders/{id}/complete', [OrderController::class, 'completeDelivery']);
Route::post('/courier/location', [CourierController::class, 'updateLocation']);
Route::get('/courier/{id}/location', [CourierController::class, 'getLocation']);

// CLIENT
Route::get('/client/orders', [ClientController::class, 'clientOrder']);
Route::get('/client/orders/{id}', [OrderController::class, 'show']);
Route::get('/client/products', [ClientController::class, 'products']);
Route::post('/client/register', [ClientController::class, 'register']);
Route::post('/client/upgrade', [ClientController::class, 'upgradeToMerchant']);

// MERCHANT
Route::get('/merchant/orders', [OrderController::class, 'indexMerchant']);
Route::post('/merchant/storefront', [MerchantController::class, 'createStorefront']);
Route::post('/merchant/storefront/product', [MerchantController::class, 'createProduct']);
Route::post('/merchant/premium-access', [MerchantController::class, 'purchasePremiumAccess']);

// PRODUCTS
Route::get('/products', [ProductController::class, 'index']);
Route::post('/products', [ProductController::class, 'store']);
Route::post('/products/edit', [ProductController::class, 'update']);
Route::delete('/products/{product}', [ProductController::class, 'destroy']);
Route::get('/products/{product}', [ProductController::class, 'show']);

// PROFILE
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/client/profile', [ProfileController::class, 'index']);
    Route::put('/client/profile', [ProfileController::class, 'update']);
    Route::post('/client/support', [SupportController::class, 'submit']);
    
    // KYC
    Route::post('/kyc/{user}', [KYCController::class, 'submitKYC']);

    // Wallet
    Route::post('/wallet/deposit', [WalletController::class, 'deposit']);
    Route::post('/wallet/withdraw', [WalletController::class, 'withdraw']);
});
