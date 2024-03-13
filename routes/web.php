<?php

use Illuminate\Support\Facades\Route;

use App\Livewire\LandingPage;
use App\Livewire\Pages\Auth\Login;
use App\Livewire\Pages\Auth\Register;
use App\Livewire\Pages\Auth\LoginPhone;
use App\Livewire\Pages\Auth\EmailVerify;
use App\Livewire\VerificationAlert;
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

// Auth Pages
Route::get('/login', Login::class)->name('login')->middleware('guest');
Route::get('/login/number', LoginPhone::class)->name('login/number')->middleware('guest');
Route::get('/register', Register::class)->name('register')->middleware('guest');
Route::get('/verify/{token}', EmailVerify::class)->name('email-verify')->middleware('guest');
Route::get('/register/verification-alert', VerificationAlert::class)->name('verificationalert')->middleware('guest');