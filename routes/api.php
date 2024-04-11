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
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserAddressController;
use App\Http\Controllers\VoucherController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\CartPageQueryController;
use App\Http\Controllers\ConversationController;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\UserProfilePageController;
use App\Http\Controllers\ProductListingPageController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\SellerRegistrationController;
use App\Http\Controllers\SellerShopController;
use App\Http\Controllers\ShopPerformanceController;
use App\Http\Controllers\UserSettingsController;
use App\Models\ShopPerformance;

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
        // Seller Shop
        Route::group(['prefix' => 'seller'], function() {
            Route::get('/shop', [SellerShopController::class, 'getSellerShop']);
            Route::post('/shopName', [SellerShopController::class, 'addSellerShop']);
        });


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
            Route::get('items', [CartController::class, 'cartItems']);
            Route::post('cartData', [CartController::class, 'cartData']);
            Route::get('cartCounter', [CartController::class, 'cartCounter']);
            Route::post('/{product_id}', [CartController::class, 'addToCart']);
        });

        // Checkout
        Route::group(['prefix' => 'checkout'], function () {
            Route::post('/{cartItem}', [CheckoutAndBuyNowController::class, 'checkout']);
            Route::patch('/buynow/{sale}/{cartItem}', [CheckoutAndBuyNowController::class, 'buynow']);
        });

        // Voucher
        Route::group(['prefix' => 'voucher'], function () {
            Route::get('/{code}', [VoucherController::class, 'getVoucher']);
            Route::post('/', [VoucherController::class, 'addVoucher']);
            Route::put('/{voucher}', [VoucherController::class, 'editVoucher']);
        });

        // Discount
        Route::group(['prefix' => 'discount'], function() {
            Route::get('/{product_id}', [DiscountController::class, 'getDiscount']);
            Route::post('/', [DiscountController::class, 'addDiscount']);
            Route::patch('/{discount}', [DiscountController::class, 'editDiscount']);
        });
    });

    Route::get('/dragonpay', [CheckoutAndBuyNowController::class, 'dragonpay']);

    // Auth Route
    Route::group(['prefix' => 'auth'], function () {
        Route::post('register', [RegistrationController::class, 'registration']);
        Route::post('registrationEmailCheck', [RegistrationController::class, 'registrationEmailCheck']);
        Route::post('login', [AuthController::class, 'login']);
        Route::post('forgotPassword', [AuthController::class, 'forgotPassword']);
        Route::post('forgotChangePassword', [AuthController::class, 'forgotChangePassword']);
        Route::group(['middleware' => 'auth:sanctum'], function () {

            Route::post('resendEmailVerification', [AuthController::class, 'resendEmailVerification']);
            Route::post('getVerifiedEmailToken', [AuthController::class, 'getVerifiedEmailToken']);
            Route::post('changePassword', [AuthController::class, 'changePassword']);
            Route::post('logout', [AuthController::class, 'logout']);

            Route::patch('onboardStyles', [OnboardingController::class, 'onboardStyles']);
            Route::patch('onboardCategories', [OnboardingController::class, 'onboardCategories']);
            Route::patch('onboardItems', [OnboardingController::class, 'onboardItems']);

            Route::get('allStyles', [OnboardingController::class, 'fetchAllStyles']);
            Route::get('allCategories', [OnboardingController::class, 'fetchAllCategories']);
            Route::get('allItems', [OnboardingController::class, 'fetchAllItems']);

            //cart
            Route::get('cart', [CartPageQueryController::class, 'loadCart']);
            Route::post('cart', [CartPageQueryController::class, 'loadCart']);
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
            Route::patch('products/{productId}/manage', [ProductListingPageController::class, 'manageListing']);
            //measurement
            Route::post('products/{productId}/measurements', [ProductListingPageController::class, 'addMeasurements']);
            //shipping
            Route::post('products/{productId}/shipping', [ProductListingPageController::class, 'addShippingDetails']);
            // Image upload routes
            Route::post('products/{productId}/images', [ImageController::class, 'uploadImage']);
            Route::delete('products/{productId}/images', [ImageController::class, 'deleteImage']);
            //seller  idk if i will group this into a middleware
            Route::get('seller/profile', [SellerRegistrationController::class, 'getSellerProfile']);
            Route::get('seller/products', [SellerRegistrationController::class, 'getSellerProducts']);
            Route::post('seller/register', [SellerRegistrationController::class, 'register']);
            Route::post('seller/verify-identity', [SellerRegistrationController::class, 'verifyIdentity']);
            Route::post('seller/submit-id', [SellerRegistrationController::class, 'submitId']);
            Route::post('seller/review-application', [SellerRegistrationController::class, 'reviewApplication']);
            Route::post('seller/complete-verification', [SellerRegistrationController::class, 'completeVerification']);
            //order
            Route::get('orders', [OrderController::class, 'getAllOrders']);
            Route::get('order/{orderId}', [OrderController::class, 'getOrderDetails']);
            Route::get('user/orders', [OrderController::class, 'getAllOrdersBySeller']);
            //sellerAccount management
            //Shop Performance
            Route::get('account/shopPerformance', [ShopPerformanceController::class, 'show']);

            //Conversations
            Route::get('/conversations', [ConversationController::class, 'index']);
            Route::post('/conversations', [ConversationController::class, 'store']);
            Route::get('/conversations/{conversation}', [ConversationController::class, 'show']);
            // Messages
            Route::get('/conversations/{conversation}/messages', [MessageController::class, 'index']);
            Route::post('/conversations/{conversation}/messages', [MessageController::class, 'store']);
            Route::get('/conversations/{conversation}/messages/{message}', [MessageController::class, 'show']);

            //user settings
            Route::patch('settings/notifications/push', [UserSettingsController::class, 'updatePushNotificationSettings']);
            Route::patch('settings/notifications/email', [UserSettingsController::class, 'updateEmailNotificationSettings']);
            Route::patch('settings/notifications/buying', [UserSettingsController::class, 'updateBuyingNotificationSettings']);
            Route::patch('settings/notifications/selling', [UserSettingsController::class, 'updateSellingNotificationSettings']);
            Route::patch('settings/privacy', [UserSettingsController::class, 'updatePrivacySettings']);
            Route::patch('settings/blocked-users', [UserSettingsController::class, 'updateBlockedUsers']);
        });
    });
});
