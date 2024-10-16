<?php

use App\Livewire\Chat\CreateChat;
use App\Livewire\Chat\Main;
use App\Livewire\Components\Download;
use Illuminate\Support\Facades\Route;

use App\Livewire\LandingPage;
use App\Livewire\Pages\Auth\Cart;
use App\Livewire\Pages\Auth\Login;
use App\Livewire\Pages\Auth\Register;
use App\Livewire\Pages\Auth\LoginPhone;
use App\Livewire\Pages\Auth\EmailVerify;
use App\Livewire\Pages\Auth\CheckoutProcess;

use App\Livewire\Pages\PrivacyTerms;
use App\Livewire\Pages\TermsConditions;
use App\Livewire\Pages\FacebookData;
use App\Livewire\Pages\ContactUs;

use App\Livewire\Pages\Shop\Component\Listing;
use App\Livewire\Pages\Shop\Component\ManageProducts;
use App\Livewire\Pages\Shop\Profile;
use App\Livewire\Pages\Shop\Shop;

use App\Livewire\Pages\Auth\ProductsInfo;
use App\Livewire\Pages\Shop\Component\Purchases;
use App\Livewire\VerificationAlert;
use App\Livewire\Preferences;
use App\Livewire\Styles;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', LandingPage::class)->name('/');
Route::get('/index', LandingPage::class)->name('index');
Route::get('/landingpage', LandingPage::class)->name('landingpage');

Route::get('/privacy-policy', PrivacyTerms::class)->name('privacy-terms');
Route::get('/terms-conditions', TermsConditions::class)->name('terms-conditions');
Route::get('/facebook-data', FacebookData::class)->name('facebook-data');

Route::get('/contact', ContactUs::class)->name('contact');

Route::get('/download', Download::class)->name('download');

//For testing chats
Route::get('/users', CreateChat::class)->name('users');
Route::get('/chat', Main::class)->name('chat');

// Auth Pages
Route::get('/login', Login::class)->name('login')->middleware('guest');
Route::get('/login/number', LoginPhone::class)->name('login/number')->middleware('guest');
Route::get('/register', Register::class)->name('register')->middleware('guest');
Route::get('/verify/{token}', EmailVerify::class)->name('email-verify')->middleware('guest');
Route::get('/register/verification-alert', VerificationAlert::class)->name('verificationalert')->middleware('guest');

Route::middleware(['auth'])->group(function () {
    Route::get('/onboarding/preferences', Preferences::class);
    Route::get('/onboarding/styles', Styles::class);

    //Profile Pages
    Route::group(['prefix' => 'user/account'], function () {
        Route::get('/profile', Profile::class)->name('profile');
        // Route::get('/profile/{user}/listing', Listing::class)->name('listing');
        Route::get('/profile/add-products', ManageProducts::class);
        Route::get('/profile/{user}/purchases', Purchases::class);
    });

    Route::get('/product/{product_id}-{category_id}-{product_code}', ProductsInfo::class)->name('productsinfo');

    //Shop
    Route::get('/shop/{category?}', Shop::class)->name('shop');

    //Cart
    Route::get('/cart', Cart::class)->name('cart');
    Route::get('/checkout-process', CheckoutProcess::class)->name('checkout.process');
});
