<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LandingPageQueryController;
use App\Http\Controllers\ProductDetailsContontroller;
use App\Http\Controllers\SearchController;

// Auth Controller
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\RegistrationController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutAndBuyNowController;
use App\Http\Controllers\MakeOfferController;
use App\Http\Controllers\OnboardingController;
use App\Http\Controllers\ProfilePageController;
use App\Http\Controllers\UserAddressController;
use App\Http\Controllers\VoucherController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group(['prefix' => 'v1'], function () {
    Route::group(['prefix' => 'landing-page'], function () {
        Route::get('exploreStyles', [LandingPageQueryController::class, 'exploreStyles']);
        Route::get('shopCategory', [LandingPageQueryController::class, 'shopCategory']);
        Route::get('getNewArrivals', [LandingPageQueryController::class, 'getNewArrivals']);
        Route::get('getOurPicks', [LandingPageQueryController::class, 'getOurPicks']);
        Route::get('getPopularItem', [LandingPageQueryController::class, 'getPopularItem']);
        Route::get('getMoreItemsForYou', [LandingPageQueryController::class, 'getMoreItemsForYou']);
        Route::get('shopSpotlight', [LandingPageQueryController::class, 'shopSpotlight']);
        Route::get('shopsToWatch', [LandingPageQueryController::class, 'shopsToWatch']);

    });
    Route::group(['prefix' => 'product-details'], function () {
        Route::get('moreFromSeller/{user_id}', [ProductDetailsContontroller::class, 'moreFromSeller']);
        Route::get('relatedProducts/{product_code}', [ProductDetailsContontroller::class, 'relatedProducts']);
    });
    Route::group(['prefix' => 'search'], function () {
        Route::get('searchHandle/{search_query}', [SearchController::class, 'searchHandle']);
    });

    Route::get('provinces', [RegistrationController::class, 'fetchProvinces']);
    Route::get('cities/{provinceCode}', [RegistrationController::class, 'fetchCities']);
    Route::get('countryCodes', [RegistrationController::class, 'fetchCountryCodes']);

    Route::get('phoneOtp/{phoneNumber}', [RegistrationController::class, 'phoneSend']);
    Route::get('emailOtp/{email}', [RegistrationController::class, 'emailSend']);
    Route::get('verifyOtp/{otpCode}', [RegistrationController::class, 'verifyCode']);

    Route::group(['middleware' => 'auth:sanctum'], function () {
        // Make Offer
        Route::group(['prefix' => 'makeOffer'], function() {
            Route::get('/{product_id}', [MakeOfferController::class, 'index']);
            Route::post('/', [MakeOfferController::class, 'store']);
            Route::patch('/{makeOffer}', [MakeOfferController::class, 'update']);
            Route::delete('/{makeOffer}', [MakeOfferController::class, 'destroy']);
        });

        // User Address
        Route::group(['prefix' => 'userAddress'], function() {
            Route::post('/', [UserAddressController::class, 'addAddress']);
            Route::put('/{userAddress}', [UserAddressController::class, 'updateAddress']);
            Route::patch('/{userAddress}', [UserAddressController::class, 'selectAddress']);
        });

        // Cart
        Route::group(['prefix' => 'cart'], function() {
            Route::get('/items', [CartController::class, 'cartItems']);
            Route::post('/{product_id}', [CartController::class, 'addToCart']);
        });

        // Checkout
        Route::group(['prefix' => 'checkout'], function() {
            Route::post('/{cartItem}', [CheckoutAndBuyNowController::class, 'checkout']);
            Route::patch('/buynow/{sale}/{cartItem}', [CheckoutAndBuyNowController::class, 'buynow']);
            Route::get('/dragonpay', [CheckoutAndBuyNowController::class, 'dragonpay']);
        });

        // Voucher
        Route::group(['prefix' => 'voucher'], function() {
            Route::get('/{code}', [VoucherController::class, 'getVoucher']);
        });
    });

    // Auth Route
    Route::group(['prefix' => 'auth'], function () {
        Route::post('register', [RegistrationController::class, 'registration']);
        Route::post('login', [AuthController::class, 'login']);
        Route::post('registerEmailChecker', [AuthController::class, 'registerEmailChecker']);
        Route::post('forgotPassword', [AuthController::class, 'forgotPassword']);
        Route::post('forgotChangePassword', [AuthController::class, 'forgotChangePassword']);
        Route::group(['middleware' => 'auth:sanctum'], function () {

            Route::get('wishlist/{user_id}', [ProfilePageController::class, 'wishlist']);

            Route::post('resendEmailVerification', [AuthController::class, 'resendEmailVerification']);
            Route::post('getVerifiedEmailToken', [AuthController::class, 'getVerifiedEmailToken']);
            Route::post('changePassword', [AuthController::class, 'changePassword']);
            Route::get('logout', [AuthController::class, 'logout']);

            Route::patch('onboardStyles', [OnboardingController::class, 'onboardStyles']);
            Route::patch('onboardCategories', [OnboardingController::class, 'onboardCategories']);
            Route::patch('onboardItems', [OnboardingController::class, 'onboardItems']);

            Route::get('allStyles', [OnboardingController::class, 'fetchAllStyles']);
            Route::get('allCategories', [OnboardingController::class, 'fetchAllCategories']);
            Route::get('allItems', [OnboardingController::class, 'fetchAllItems']);
        });
    });
});
