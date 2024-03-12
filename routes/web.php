<?php

use Illuminate\Support\Facades\Route;

use App\Livewire\LandingPage;
use App\Livewire\Pages\Auth\Login;
use App\Livewire\Pages\Auth\Register;

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
Route::get('/login', Login::class)->name('login');
Route::get('/register', Register::class)->name('register');