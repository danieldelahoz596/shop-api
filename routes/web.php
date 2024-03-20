<?php

use Illuminate\Support\Facades\Route;

use App\Livewire\LandingPage;
use App\Livewire\Pages\Auth\Login;
use App\Livewire\Pages\Auth\Register;
use App\Livewire\Pages\Auth\LoginPhone;
use App\Livewire\Pages\Auth\EmailVerify;
use App\Livewire\Pages\Shop\Component\Listing;
use App\Livewire\Pages\Shop\Component\ManageProducts;
use App\Livewire\Pages\Shop\Profile;
use App\Livewire\Pages\Shop\Shop;

use App\Livewire\Pages\Auth\ProductsInfo;

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
Route::get('/products-info', ProductsInfo::class)->name('productsinfo');

// Auth Pages
Route::get('/login', Login::class)->name('login')->middleware('guest');
Route::get('/login/number', LoginPhone::class)->name('login/number')->middleware('guest');
Route::get('/register', Register::class)->name('register')->middleware('guest');
Route::get('/verify/{token}', EmailVerify::class)->name('email-verify')->middleware('guest');
Route::get('/register/verification-alert', VerificationAlert::class)->name('verificationalert')->middleware('guest');
Route::get('/onboarding/preferences', Preferences::class);
Route::get('/onboarding/styles', Styles::class);

//Profile Pages
Route::get('/profile/{user}', Profile::class)->name('profile');
Route::get('/profile/{user}/listing', Listing::class)->name('listing');
Route::get('/profile/{user}/add-products', ManageProducts::class);
//Shop
Route::get('/shop/{keyword}', Shop::class)->name('shop');
