<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;

/*
|--------------------------------------------------------------------------
| Public Routes (Guest)
|--------------------------------------------------------------------------
*/

Route::get('/', fn () => redirect()->route('login'));

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.perform');

Route::get('/signup', [RegisterController::class, 'showSignupForm']);
Route::post('/signup', [RegisterController::class, 'register'])->name('signup.perform');

Route::get('/about', fn () => view('about'))->name('about');
Route::get('/contacts', fn () => view('contacts'))->name('contacts');

/*
|--------------------------------------------------------------------------
| Protected Routes (Authenticated Users Only)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    // Auth
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/home', fn () => view('home'))->name('home');

    // Profile
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // Menu
    Route::get('/menu', [MenuController::class, 'index'])->name('menu.index');
    Route::get('/menu/category/{id}', [MenuController::class, 'showCategory'])->name('menu.category');
    Route::get('/menu/subcategory/{id}', [MenuController::class, 'showSubcategory'])->name('menu.subcategory.show');

    // Cart Routes
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('/cart/cancel', [CartController::class, 'cancelOrder'])->name('cart.cancel');

    // Checkout
    Route::post('/cart/checkout', [PaymentController::class, 'checkout'])->name('cart.checkout');

    // GCash Payment
    Route::get('/payment/gcash/{orderId}', [PaymentController::class, 'showGCashGateway'])->name('payment.gcash');
    Route::post('/payment/gcash/callback/{orderId}', [PaymentController::class, 'gcashCallback'])->name('payment.gcash.callback');

    Route::prefix('payment')->name('payment.')->group(function() {
    Route::get('cod/{orderId}', [PaymentController::class, 'showCODGateway'])->name('cod');
    Route::post('cod/callback/{orderId}', [PaymentController::class, 'codCallback'])->name('cod.callback');
});

    // Payment completed page
    Route::get('/payment/completed', fn () => view('cart.payment.completed'))->name('payment.completed');

});
