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
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\CartPageQueryController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\UserProfilePageController;
use App\Http\Controllers\ProductListingPageController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\SellerRegistrationController;

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
        Route::group(['prefix' => 'makeOffer'], function () {
            Route::get('/{product_id}', [MakeOfferController::class, 'index']);
            Route::post('/', [MakeOfferController::class, 'store']);
            Route::patch('/{makeOffer}', [MakeOfferController::class, 'update']);
            Route::delete('/{makeOffer}', [MakeOfferController::class, 'destroy']);
        });

        // User Address
        Route::group(['prefix' => 'userAddress'], function () {
            Route::post('/', [UserAddressController::class, 'addAddress']);
            Route::put('/{userAddress}', [UserAddressController::class, 'updateAddress']);
            Route::patch('/{userAddress}', [UserAddressController::class, 'selectAddress']);
        });

        // Cart
        Route::group(['prefix' => 'cart'], function () {
            Route::get('/items', [CartController::class, 'cartItems']);
            Route::post('/{product_id}', [CartController::class, 'addToCart']);
        });

        // Checkout
        Route::group(['prefix' => 'checkout'], function () {
            Route::post('/{cartItem}', [CheckoutAndBuyNowController::class, 'checkout']);
            Route::patch('/buynow/{sale}/{cartItem}', [CheckoutAndBuyNowController::class, 'buynow']);
            Route::get('/dragonpay', [CheckoutAndBuyNowController::class, 'dragonpay']);
        });

        // Voucher
        Route::group(['prefix' => 'voucher'], function () {
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

            //cart
            Route::get('cart', [CartPageQueryController::class, 'loadCart']);
            Route::delete('cart/items/{itemId}', [CartPageQueryController::class, 'deleteItem']);
            Route::post('cart/checkout', [CartPageQueryController::class, 'checkout']);
            //userprofile
            Route::get('user/profile', [UserProfilePageController::class, 'getProfile']);
            Route::post('user/profile', [UserProfilePageController::class, 'updateProfile']);

            //wishlist
            Route::get('wishlist/{user_id}', [WishlistController::class, 'wishlist']);
            Route::post('wishlist', [WishlistController::class, 'addProductToWishlist']);
            Route::delete('wishlist/{user_id}/{product_id}', [WishlistController::class, 'removeProductFromWishlist']);

            //reviews
            //type = product or seller
            Route::post('reviews/{type}/{user_id}', [ReviewController::class, 'addReview']);
            Route::get('reviews/{type}/{user_id}', [ReviewController::class, 'getReviews']);
            Route::put('reviews/{review_id}', [ReviewController::class, 'updateReview']);
            Route::get('reviewsHistory/{review_id}', [ReviewController::class, 'getHistoryReview']);
            //product listing
            Route::get('products', [ProductListingPageController::class, 'listProducts']);
            Route::post('products', [ProductListingPageController::class, 'addProduct']);
            Route::put('products/{productId}', [ProductListingPageController::class, 'editProduct']);
            Route::delete('products/{productId}', [ProductListingPageController::class, 'deleteProduct']);
            //measurement
            Route::post('products/{productId}/measurements', [ProductListingPageController::class, 'addMeasurements']);
            //shipping
            Route::post('products/{productId}/shipping', [ProductListingPageController::class, 'addShippingDetails']);
            // Image upload routes
            Route::post('products/{productId}/images', [ImageController::class, 'uploadImage']);
            Route::delete('products/{productId}/images', [ImageController::class, 'deleteImage']);
            //seller
            Route::post('seller/register', [SellerRegistrationController::class, 'register']);
            Route::post('seller/verify-identity', [SellerRegistrationController::class, 'verifyIdentity']);
            Route::post('seller/submit-id', [SellerRegistrationController::class, 'submitId']);
            Route::post('seller/review-application', [SellerRegistrationController::class, 'reviewApplication']);
            Route::post('seller/complete-verification', [SellerRegistrationController::class, 'completeVerification']);
        });
    });
});