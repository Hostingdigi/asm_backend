<?php

use App\Http\Controllers\Api\ApiAuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

use App\Http\Controllers\Api\ApiController;

Route::post('register', [ApiAuthController::class, 'register']);
Route::post('login', [ApiAuthController::class, 'login']);
Route::post('forgot-password', [ApiAuthController::class, 'forgotPasswordRequest']);
Route::post('verify-otp', [ApiAuthController::class, 'verifyOTP']);
Route::post('update-forgot-password', [ApiAuthController::class, 'forgotPasswordUpdate']);

Route::get('categories', [ApiController::class, 'listCategories']);
Route::get('brands', [ApiController::class, 'listBrands']);
Route::get('promocodes', [ApiController::class, 'listPromocodes']);
Route::post('frequent-bought-items', [ApiController::class, 'listFrequentItems']);

Route::post('last-minute-items', [ApiController::class, 'lastMinuteItems']);
Route::get('dynamic-pages/{page}', [ApiController::class, 'dynamicPages']);
Route::get('payment-methods', [ApiController::class, 'paymentMethods']);

Route::prefix('products')->group(function () {

    Route::middleware(['auth:api'])->group(function () {
        Route::post('add-to-wishlist', [ApiController::class, 'addToWishlist']);
        Route::get('list-wishlist', [ApiController::class, 'ListWishlist']);
        Route::post('remove-wishlist', [ApiController::class, 'removeWishlist']);
    });

    Route::post('/', [ApiController::class, 'listProducts']);
    Route::get('/{productId}/{userId?}', [ApiController::class, 'productDetails']);

});

Route::middleware(['auth:api'])->group(function () {

    Route::post('change-password', [ApiAuthController::class, 'changePassword']);
    Route::get('logout', [ApiAuthController::class, 'logout']);

    Route::post('save-address', [ApiController::class, 'saveAddress']);
    Route::get('address', [ApiController::class, 'getAddress']);

    Route::post('create-order', [ApiController::class, 'createOrder']);
    Route::post('my-orders', [ApiController::class, 'listMyOrders']);

    Route::post('user/profile-update', [ApiAuthController::class, 'profileUpdate']);

    //Cart
    Route::prefix('cart')->group(function () {

        Route::get('list', [ApiController::class, 'listCartItems']);
        Route::post('add-item', [ApiController::class, 'addItem']);
        Route::post('update-item', [ApiController::class, 'updateItem']);
        Route::post('remove-item', [ApiController::class, 'removeItem']);
        Route::get('clear', [ApiController::class, 'clearCart']);

        // Route::get('/{productId}', [ApiController::class, 'productDetails']);

    });
});

Route::fallback(function () {
    return response()->json([
        'status' => true,
        'message' => 'Not Found',
        'data' => null,
    ], 404);
});
