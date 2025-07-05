<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebAuthController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SupportController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\MerchantController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CourierController;
use App\Http\Controllers\StorekeeperController;
use App\Http\Controllers\KYCController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\WalletController;
use App\Models\Order;
use App\Http\Controllers\StorefrontController;


Route::get('/merchant/orders', [MerchantController::class, 'showOrdersForMerchant'])->name('merchant.orders.show');
Route::get('/admin/orders/{id}/edit', [OrderController::class, 'edit'])->name('admin.orders.edit');
Route::delete('/admin/orders/{id}', [OrderController::class, 'destroy'])->name('admin.orders.delete');
Route::get('/merchant/orders/{id}/track', [OrderController::class, 'trackOrder'])->name('merchant.orders.track');
Route::get('/client/orders/{id}/track', [OrderController::class, 'trackOrder'])->name('client.orders.track');
Route::post('/client/orders/{id}/cancel', [OrderController::class, 'cancelOrder'])->name('client.orders.cancel');
Route::post('/courier/orders/{id}/start', [OrderController::class, 'startDelivery'])->name('courier.orders.start');
Route::get('/courier/orders/{id}/complete', [OrderController::class, 'completeDelivery'])->name('courier.orders.complete');
Route::get('/orders/{id}', [OrderController::class, 'show'])->name('orders.show');
Route::get('/get-towns/{country}', [OrderController::class, 'getTowns']);
Route::post('/verify-code/{orderId}', [OrderController::class, 'verifyCode'])->name('verify.code');
Route::get('/get-quarters/{town}', [OrderController::class, 'getQuarters']);
Route::get('/storefronts/{id}', [StorefrontController::class, 'show'])->name('storefronts.show');
Route::get('/merchant/storefronts/{id}', [MerchantController::class, 'viewStorefront'])->name('merchant.storefront.view');
Route::get('/merchant/order/track/{id}', [MerchantController::class, 'trackOrder'])->name('merchant.orders.track');
Route::get('/courier/orders/track/{id}', [CourierController::class, 'trackOrder'])->name('courier.orders.track');
Route::get('/client/order/track/{id}', [ClientController::class, 'trackOrder'])->name('client.orders.track');
Route::post('/courier/location', [CourierController::class, 'updateLocation'])->name('courier.location.update');
Route::get('/storefronts/{storefrontId}/add-product', [ProductController::class, 'create'])->name('products.create');
Route::post('/merchant/storefront/product', [MerchantController::class, 'createProduct'])->name('merchant.createProduct');
Route::post('/merchant/storefront', [MerchantController::class, 'createStorefront'])->name('merchant.storefrontcreate');
Route::get('/merchant/dashboard', [MerchantController::class, 'dashboard'])->name('merchant.dashboard');
Route::get('/merchant/storefront/page', [MerchantController::class, 'storefronts'])->name('merchant.storefronts');
Route::get('/merchant/storefront/create', [MerchantController::class, 'storefrontCreatepage'])->name('merchant.storefront.create');
Route::post('/merchant/premium-access', [MerchantController::class, 'purchasePremiumAccess'])->name('merchant.purchasePremiumAccess');
Route::get('/courier/verification/{orderId}', [OrderController::class, 'verificationPage'])->name('courier.verification');
Route::post('/courier/verification/{orderId}', [OrderController::class, 'verifyCode'])->name('verify-code');
Route::get('/courier/{id}/location', [CourierController::class, 'getLocation'])->name('get.courier.location');
Route::get('/get-courier-location', function (Request $request) {
    $order = Order::find($request->order_id);
    return response()->json([
        'latitude' => $order->courier_latitude,
        'longitude' => $order->courier_longitude,
    ]);
});
Route::get('/courier/deliveries/start/{order}', [CourierController::class, 'startDelivery'])->name('courier.deliveries.start');

Route::get('/deliveries/start/{order}', [OrderController::class, 'startDelivery'])->name('deliveries.start');
Route::get('/client/orders/index', [ClientController::class, 'clientOrder'])->name('client.orders.index');

Route::get('merchant/orders', [OrderController::class, 'indexMerchant'])->name('merchant.orders.index');
Route::get('merchant/orders/{id}', [OrderController::class, 'show'])->name('merchant.orders.show');
Route::get('/track/{order}', [OrderController::class, 'track'])->name('track.delivery');
Route::get('/orders/{id}/track', [OrderController::class, 'track'])->name('orders.track');
Route::post('/update-location', [OrderController::class, 'updateCourierLocation'])->name('update-location');
Route::get('/tracking/{orderId}', [OrderController::class, 'trackingPage'])->name('tracking.page');
// Authentication routes
Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/', [LoginController::class, 'login']);
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/'); // Redirect to the homepage or any other route after logout
})->name('logout');

Route::get('/products', [ProductController::class, 'index'])->name('products.index');
   // Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::post('/products/edit', [ProductController::class, 'update'])->name('products.edit');
    Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');
    Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
    Route::get('/client/products', [ClientController::class, 'products'])->name('client.products.index');

// Client registration routes
Route::get('/client/register', [ClientController::class, 'showRegisterForm'])->name('client.register.form');
Route::post('/client/register', [ClientController::class, 'register'])->name('client.register');
Route::get('/client/dashboard', [ClientController::class, 'dashboard'])->name('client.dashboard');
Route::get('/client/upgrade', [ClientController::class, 'showUpgradeForm'])->name('client.upgrade.form');
Route::post('/client/upgrade/form', [ClientController::class, 'upgradeToMerchant'])->name('client.upgrade');

// Middleware for authenticated users
Route::middleware(['auth'])->group(function () {
    // Common order routes
    Route::get('/orders/create/{productId}', [OrderController::class, 'display'])->name('orders.create');
    Route::get('/orders/index', [OrderController::class, 'index'])->name('orders.index');
    
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');

    // Client routes
    Route::get('/client/profile', [ProfileController::class, 'index'])->name('client.profile');
    Route::put('/client/profile', [ProfileController::class, 'update'])->name('client.profile.update');
    Route::get('/client/support', [SupportController::class, 'show'])->name('client.support');
    Route::post('/client/support', [SupportController::class, 'submit'])->name('client.support.submit');
    Route::get('/client/orders', [OrderController::class, 'create'])->name('client.orders');
    Route::get('/client/orders/{id}', [OrderController::class, 'show'])->name('client.orders.show');

    // Merchant routes
    Route::get('/orders', [OrderController::class, 'index'])->name('merchant.orders');
    Route::get('/merchant/orders/{id}', [OrderController::class, 'show'])->name('merchant.orders.show');

    // Other product management routes for merchants
    //Route::resource('products', ProductController::class)->except(['index', 'create', 'store']);

    // Dashboard for merchant
    Route::get('/merchant/dashboard', [MerchantController::class, 'dashboard'])->name('merchant.dashboard');

    // KYC routes
    Route::get('/kyc/{user}', [KYCController::class, 'showKYCForm'])->name('kyc.form');
    Route::post('/kyc/{user}', [KYCController::class, 'submitKYC'])->name('kyc.submit');
});

// Super Admin routes
Route::group(['middleware' => ['role:Super Admin']], function() {
    Route::get('/superadmin/dashboard', [SuperAdminController::class, 'index'])->name('superadmin.dashboard');
    Route::get('/admin/create', [AdminController::class, 'createForm'])->name('admin.create.form'); 
    Route::post('/admin/register', [AdminController::class, 'register'])->name('admin.register'); 
});
Route::get('/wallet/transaction', [WalletController::class, 'showTransactionForm'])->name('wallet.transaction.form');
Route::post('/wallet/deposit', [WalletController::class, 'deposit'])->name('wallet.deposit');
Route::post('/wallet/withdraw', [WalletController::class, 'withdraw'])->name('wallet.withdraw');
Route::get('/profile/edit', [ClientController::class, 'editImage'])->name('profile.edit');
    Route::put('/profile/update', [ClientController::class, 'updateImage'])->name('profile.update');
    
Route::middleware(['auth'])->group(function () {
    Route::get('/merchant/index', [MerchantController::class, 'index'])->name('merchant.index');
    
    Route::get('/admin/merchant/create', [MerchantController::class, 'create'])->name('admin.merchant.create');
    Route::post('/merchant/store', [MerchantController::class, 'store'])->name('merchant.store');
});
// Admin routes
Route::group(['middleware' => ['auth', 'role:Admin']], function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

    // User management routes
    Route::group(['middleware' => ['permission:manage users']], function() {
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
    });
    // Courier management routes
    //Route::resource('/admin/couriers', CourierController::class)->except(['show']);
    Route::get('/admin/couriers', [CourierController::class, 'index'])->name('admin.couriers.index');
    Route::get('/admin/couriers/edit', [CourierController::class, 'edit'])->name('admin.couriers.edit');
    Route::post('/admin/couriers/update', [CourierController::class, 'update'])->name('admin.couriers.update');
    
    Route::delete('/admin/couriers/{id}', [CourierController::class, 'destroy'])->name('admin.couriers.destroy');
    Route::delete('/admin/delete', [CourierController::class, 'delete'])->name('admin.couriers.delete');
    Route::get('/admin/couriers/create', [CourierController::class, 'create'])->name('admin.couriers.create');
    Route::post('/admin/couriers/store', [CourierController::class, 'store'])->name('admin.couriers.store');
    
    // Storekeeper management routes
    //Route::resource('/admin/storekeepers', StorekeeperController::class)->except(['show']);
    Route::get('/admin/storekeepers', [StorekeeperController::class, 'index'])->name('admin.storekeepers.index');
    Route::get('/admin/storekeepers/create', [StorekeeperController::class, 'create'])->name('admin.storekeepers.create');
    Route::post('/admin/storekeepers/update', [StorekeeperController::class, 'update'])->name('admin.storekeepers.update');
    
    Route::get('/admin/storekeepers/edit', [StorekeeperController::class, 'edit'])->name('admin.storekeepers.edit');
    Route::post('/admin/storekeepers/store', [StorekeeperController::class, 'store'])->name('admin.storekeepers.store');
    Route::delete('/admin/storekeepers/{id}', [StorekeeperController::class, 'destroy'])->name('admin.storekeepers.destroy');
});

// Courier Routes
Route::group(['middleware' => ['auth', 'role:Courier']], function () {
    Route::get('/courier/dashboard', [CourierController::class, 'dashboard'])->name('courier.dashboard');
    Route::get('/courier/orders', [CourierController::class, 'viewOrders'])->name('courier.orders');
    Route::post('/courier/orders/{order}/start', [CourierController::class, 'startDelivery'])->name('courier.orders.start');
    Route::post('/courier/orders/{order}/complete', [CourierController::class, 'completeDelivery'])->name('');
});

// Storekeeper Routes
Route::group(['middleware' => ['auth', 'role:Storekeeper']], function () {
    Route::get('/storekeeper/dashboard', [StorekeeperController::class, 'dashboard'])->name('storekeeper.dashboard');
    //Route::resource('storekeeper/products', StorekeeperController::class);
    Route::get('/storekeeper/orders', [StorekeeperController::class, 'viewOrders'])->name('storekeeper.orders');
    Route::post('/storekeeper/orders/{order}/fulfill', [StorekeeperController::class, 'fulfillOrder'])->name('storekeeper.orders.fulfill');
});

// Optional: Route to the delivery form
Route::get('/delivery-form', function () {
    return view('delivery_form'); // Return the Blade view for the delivery form
});

// Dashboard accessible by Admin and Super Admin
Route::group(['middleware' => ['role:Admin|Super Admin']], function() {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
});




// WebAuth routes
Route::get('/description/{product}', [ProductController::class, 'description'])->name('products.description');
// Routes du panier
Route::prefix('cart')->group(function () {
    Route::get('/', [CartController::class, 'view'])->name('cart.view');
    Route::post('/add', [CartController::class, 'add'])->name('cart.add');
    Route::post('/update/{product}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/remove/{product}', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('/clear', [CartController::class, 'clear'])->name('cart.clear');
    Route::get('/checkout', [CartController::class, 'showCheckout'])->name('cart.checkout');
    Route::post('/checkout', [CartController::class, 'processCheckout'])->name('cart.processCheckout');

});

use App\Models\Address;

// Route pour récupérer les quartiers d'une ville
Route::get('/get-quarters/{town}', function($town) {
    $quarters = Address::where('town', $town)
                      ->select('quarter', 'latitude', 'longitude', 'fees')
                      ->get()
                      ->map(function($item) {
                          return [
                              'quarter' => $item->quarter,
                              'latitude' => $item->latitude,
                              'longitude' => $item->longitude
                          ];
                      });
    
    return response()->json(['quarters' => $quarters]);
});

// Route pour récupérer les frais de livraison d'un quartier
Route::get('/get-delivery-fees/{quarter}', function($quarter) {
    $address = Address::where('quarter', $quarter)->first();
    
    if ($address) {
        return response()->json(['fees' => $address->fees]);
    }
    
    return response()->json(['fees' => 0], 404);
});

Route::get('/client/products/interests', [ClientController::class, 'productsByInterests'])->name('client.products.interests');