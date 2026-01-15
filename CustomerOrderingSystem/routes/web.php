<?php


use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ItemController;

Route::get('/', function () { return redirect('/login'); });

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.perform');

Route::get('/signup', [RegisterController::class, 'showSignupForm']);
Route::post('/signup', [RegisterController::class, 'register'])->name('signup.perform');

Route::get('/home', function () {
    return view('home'); // Ensure your 2nd code snippet is saved as home.blade.php
})->name('home');

Route::post('/logout', [LoginController::class, 'logout']);

Route::get('/about', function () {
    return view('about'); // Assumes the file is resources/views/about.blade.php
})->name('about');

Route::get('/contacts', function () {
    return view('contacts'); // Loads the contacts.blade.php file
})->name('contacts');

// Protected Routes Group (requires user to be logged in)
Route::middleware(['auth'])->group(function () {

    // ... existing protected routes (like /home) ...

    // User Profile Page Route
    Route::get('/profile', function () {
        // Pass the authenticated user data to the view
        return view('profile', ['user' => Auth::user()]); 
    })->name('profile');

    // ... other protected routes ...
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])
        ->name('profile');

    Route::get('/profile/edit', [ProfileController::class, 'edit'])
        ->name('profile.edit');
});


// The main menu page
Route::get('/menu', [MenuController::class, 'index'])->name('menu.index');

// The specific category page (e.g., /menu/1 for Coffee)
Route::get('/menu', [MenuController::class, 'index'])->name('menu.index');
Route::get('/menu/{id}', [MenuController::class, 'show'])->name('menu.category');
Route::get('/item/{id}', [ItemController::class, 'show'])->name('item.show');

Route::middleware(['auth'])->group(function () {
    // ... other protected routes ...

    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add', [CartController::class, 'addItem'])->name('cart.add');
    Route::post('/cart/remove/{itemId}', [CartController::class, 'removeItem'])->name('cart.remove');
    Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
    Route::post('/cart/cancel', [CartController::class, 'cancel'])->name('cart.cancel');
    Route::post('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
    Route::post('/cart/confirm', [CartController::class, 'showConfirmation'])->name('cart.confirm.submit');
    Route::get('/cart/confirm', [CartController::class, 'confirmPage'])->name('cart.confirm');
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add', [CartController::class, 'addItem'])->name('cart.add');
    Route::post('/order/proceed', [CartController::class, 'processOrder'])->name('order.proceed');
    Route::get('/payment/completed', [CartController::class, 'showCompletedPage'])->name('payment.completed');

    Route::post('/order/proceed', [CartController::class, 'processOrder'])->name('order.proceed');
    Route::get('/payment/completed', [CartController::class, 'showCompletedPage'])->name('payment.completed');

});

