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
use App\Http\Controllers\Api\PaymentController;

Route::get('app-data', [ApiController::class, 'getAppData']);
Route::get('p-check', [ApiController::class, 'pCheck']);

Route::group(['middleware' => ['json.response']], function () {

    Route::post('register', [ApiAuthController::class, 'register']);
    Route::post('login', [ApiAuthController::class, 'login']);
    Route::post('forgot-password', [ApiAuthController::class, 'forgotPasswordRequest']);
    Route::post('verify-otp', [ApiAuthController::class, 'verifyOTP']);
    Route::post('update-forgot-password', [ApiAuthController::class, 'forgotPasswordUpdate']);

    Route::get('home-page/banners', [ApiController::class, 'homePageBanners']);
    Route::get('categories', [ApiController::class, 'listCategories']);
    Route::get('brands', [ApiController::class, 'listBrands']);
    Route::get('promocodes', [ApiController::class, 'listPromocodes']);
    Route::post('frequent-bought-items', [ApiController::class, 'listFrequentItems']);

    Route::post('last-minute-items', [ApiController::class, 'lastMinuteItems']);
    Route::get('dynamic-pages', [ApiController::class, 'dynamicPages']);
    Route::get('payment-methods', [ApiController::class, 'paymentMethods']);

    Route::middleware(['auth:api'])->group(function () {
        Route::post('wishlist/update', [ApiController::class, 'addToWishlist']);
        Route::get('wishlist/list', [ApiController::class, 'ListWishlist']);
    });

    Route::prefix('products')->group(function () {

        Route::post('/', [ApiController::class, 'listProducts']);
        Route::post('search-name', [ApiController::class, 'searchProductNames']);
        Route::post('search', [ApiController::class, 'searchProducts']);
        Route::post('detail', [ApiController::class, 'productDetails']);

    });

    Route::get('countries', [ApiController::class, 'listCountries']);

    Route::middleware(['auth:api'])->group(function () {

        Route::post('referral-details', [ApiController::class, 'referralDetails']);

        Route::post('promocodes/update', [ApiController::class, 'applyPromocode']);

        Route::post('change-password', [ApiAuthController::class, 'changePassword']);
        Route::get('logout', [ApiAuthController::class, 'logout']);

        Route::post('save-address', [ApiController::class, 'saveAddress']);
        Route::get('address', [ApiController::class, 'getAddress']);

        Route::post('create-order', [ApiController::class, 'createOrder']);
        Route::post('my-orders', [ApiController::class, 'listMyOrders']);
        Route::post('order/update-pod-payment-status', [ApiController::class, 'updatePodStatus']);
        Route::post('order/update-card-payment-status', [ApiController::class, 'updatecardStatus']);

        Route::post('user/profile-update', [ApiAuthController::class, 'profileUpdate']);

        //Cart
        Route::prefix('cart')->group(function () {

            Route::get('list', [ApiController::class, 'listCartItems']);
            Route::post('add-item', [ApiController::class, 'addItem']);
            Route::post('remove-item', [ApiController::class, 'removeItem']);
            Route::get('clear', [ApiController::class, 'clearCart']);
            Route::post('checkout', [ApiController::class, 'cartCheckout']);
            Route::get('info', [ApiController::class, 'cartInfo']);
            Route::post('update-cut-options', [ApiController::class, 'cartUpdateCutOptions']);
            // Route::get('/{productId}', [ApiController::class, 'productDetails']);

        });

        Route::prefix('payment')->group(function () {
            Route::post('create-ekey', [PaymentController::class, 'createEKey']);
            Route::post('stripe-intend', [PaymentController::class, 'createStripePaymentIntend']);

        });
    });

    Route::fallback(function () {
        return response()->json([
            'status' => true,
            'message' => 'Not Found',
            'data' => null,
        ], 404);
    });

});
