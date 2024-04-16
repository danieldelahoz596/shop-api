<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LandingPageQueryController;
use App\Http\Controllers\ProductDetailsContontroller;
use App\Http\Controllers\SearchController;

// Auth Controller
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\RegistrationController;
use App\Http\Controllers\BlockedUserController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutAndBuyNowController;
use App\Http\Controllers\MakeOfferController;
use App\Http\Controllers\OnboardingController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserAddressController;
use App\Http\Controllers\VoucherController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\CartPageQueryController;
use App\Http\Controllers\CategoryController;
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
use App\Http\Controllers\UserVerificationController;
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
        Route::group(['prefix' => 'seller'], function () {
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

        // Voucher
        Route::group(['prefix' => 'voucher'], function () {
            Route::get('/{code}', [VoucherController::class, 'getVoucher']);
            Route::post('/', [VoucherController::class, 'addVoucher']);
            Route::put('/{voucher}', [VoucherController::class, 'editVoucher']);
            Route::delete('/{voucher}', [VoucherController::class, 'removeVoucher']);
        });

        // Discount
        Route::group(['prefix' => 'discount'], function () {
            Route::get('/{product_id}', [DiscountController::class, 'getDiscount']);
            Route::post('/', [DiscountController::class, 'addDiscount']);
            Route::patch('/{discount}', [DiscountController::class, 'editDiscount']);
        });

        // Categories
        Route::group(['prefix' => 'categories'], function () {
            Route::get('/filters', [CategoryController::class, 'productFilter']);
            Route::get('/', [CategoryController::class, 'categories']);
            Route::get('subCategories/{category_id}', [CategoryController::class, 'subCategories']);
            Route::get('subSubCategories/{subcategory_id}', [CategoryController::class, 'subSubCategories']);
            Route::get('brands', [CategoryController::class, 'brands']);
            Route::get('styles', [CategoryController::class, 'styles']);
            Route::get('sizes', [CategoryController::class, 'sizes']);
            Route::get('colors', [CategoryController::class, 'colors']);
        });

        // User Settings
        Route::group(['prefix' => 'settings'], function() {
            Route::patch('/notifications', [UserSettingsController::class, 'updateNotificationSettings']);
            Route::patch('/notifications/buying', [UserSettingsController::class, 'updateBuyingNotificationSettings']);
            Route::patch('/notifications/buying/email', [UserSettingsController::class, 'updateBuyingEmailNotificationSettings']);
            Route::patch('/privacy', [UserSettingsController::class, 'updatePrivacySettings']);
        });

        // Blocked Users
        Route::group(['prefix' => 'blocked'], function() {
            Route::get('/', [BlockedUserController::class, 'getBlockedUsers']);
            Route::post('/', [BlockedUserController::class, 'addBlockedUser']);
        });

        // Checkout
        Route::group(['prefix' => 'checkout'], function () {
            Route::post('/{cartItem}', [CheckoutAndBuyNowController::class, 'checkout']);
            Route::get('/buynow/{sale}/{cartItem}', [CheckoutAndBuyNowController::class, 'buynow']);
        });

        //user profile
        Route::group(['prefix' => 'user'], function() {
            Route::get('/profile', [UserProfilePageController::class, 'getProfile']);
            Route::patch('/profile', [UserProfilePageController::class, 'updateProfile']);
        });

        //wishlist
        Route::group(['prefix' => 'wishlist'], function() {
            Route::get('/', [WishlistController::class, 'wishlist']);
            Route::post('/', [WishlistController::class, 'addProductToWishlist']);
            Route::delete('/{wishlist}', [WishlistController::class, 'removeProductFromWishlist']);
        });
    });

    Route::get('/payment/{sale}', [CheckoutAndBuyNowController::class, 'payment']);

    // Auth Route
    Route::group(['prefix' => 'auth'], function () {
        Route::post('register', [RegistrationController::class, 'registration']);
        Route::post('registrationEmailCheck', [RegistrationController::class, 'registrationEmailCheck']);
        Route::post('login', [AuthController::class, 'login']);
        Route::post('forgotPassword', [AuthController::class, 'forgotPassword']);
        Route::post('forgotChangePassword', [AuthController::class, 'forgotChangePassword']);
        Route::post('sellerVerification/{user}', [UserVerificationController::class, 'addSellerVerification']);
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
            Route::prefix('cart')->group(function () {
                Route::get('/', [CartPageQueryController::class, 'loadCart']);
                Route::post('/', [CartPageQueryController::class, 'loadCart']);
                Route::delete('/items/{itemId}', [CartPageQueryController::class, 'deleteItem']);
                Route::post('/checkout', [CartPageQueryController::class, 'checkout']);
            });
            // user
            Route::prefix('user')->group(function () {
                Route::get('/profile', [UserProfilePageController::class, 'getProfile']);
                Route::post('/profile', [UserProfilePageController::class, 'updateProfile']);
            });

            //wishlist
            Route::group(['prefix'=>'wishlist'], function(){
                Route::get('/', [WishlistController::class, 'wishlist']);
                Route::post('/{product_id}', [WishlistController::class, 'addProductToWishlist']);
                Route::delete('/{product_id}', [WishlistController::class, 'removeProductFromWishlist']);
            });

            //reviews
            Route::group(['prefix' => 'reviews'], function() {
                Route::get('/history/{review_id}', [ReviewController::class, 'getHistoryReview']);
                Route::post('/{type}/{type_id}', [ReviewController::class, 'addReview']);
                Route::get('/{type}/{type_id}', [ReviewController::class, 'getReviews']);
                Route::put('/{review_id}', [ReviewController::class, 'updateReview']);
            });
            //product listing
            Route::group(['prefix'=>'products'], function (){
                //Manage Listing
                Route::get('/', [ProductListingPageController::class, 'listProducts']);
                Route::post('/', [ProductListingPageController::class, 'addProduct']);
                Route::put('/{productId}', [ProductListingPageController::class, 'editProduct']);
                Route::delete('/{productId}', [ProductListingPageController::class, 'deleteProduct']);
                Route::patch('/{productId}/manage', [ProductListingPageController::class, 'manageListing']);
                //measurement
                Route::post('/{productId}/measurements', [ProductListingPageController::class, 'addMeasurements']);
                //shipping
                Route::post('/{productId}/shipping', [ProductListingPageController::class, 'addShippingDetails']);
                // Image upload routes
                Route::post('/{productId}/images', [ImageController::class, 'uploadImage']);
                Route::delete('/{productId}/images', [ImageController::class, 'deleteImage']);
            });
            //seller
            Route::group(['prefix'=>'seller'], function(){
                Route::get('/profile', [SellerRegistrationController::class, 'getSellerProfile']);
                Route::get('/products', [SellerRegistrationController::class, 'getSellerProducts']);
                Route::get('/orders', [SellerRegistrationController::class, 'getSellerOrders']);
                Route::get('/products', [SellerRegistrationController::class, 'getSellerProducts']);
                Route::post('/register', [SellerRegistrationController::class, 'register']);
                Route::post('/verify-identity', [SellerRegistrationController::class, 'verifyIdentity']);
                Route::post('/submit-id', [SellerRegistrationController::class, 'submitId']);
                Route::post('/review-application', [SellerRegistrationController::class, 'reviewApplication']);
                Route::post('/complete-verification', [SellerRegistrationController::class, 'completeVerification']);
                //Shop Performance
                Route::get('/shop-performance', [ShopPerformanceController::class, 'show']);
            });

            //order
            Route::get('orders', [OrderController::class, 'getAllOrders']);
            Route::get('order/{orderId}', [OrderController::class, 'getOrderDetails']);
            Route::get('user/orders', [OrderController::class, 'getAllOrdersBySeller']);
            //sellerAccount management


            //Conversations
            Route::get( '/conversation', [ConversationController::class, 'getAllConversation']);
            Route::post('/conversation', [ConversationController::class, 'createNewConversation']);
            Route::get('/conversation/{conversation_id}', [ConversationController::class, 'getSpecificConversation']);
            // Messages
            Route::get('/conversations/{conversation}/messages', [MessageController::class, 'index']);
            Route::post('/conversations/{conversation}/messages', [MessageController::class, 'store']);
        });
    });
});
