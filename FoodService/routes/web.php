<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ChefController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\CookingClassController;

Route::get('/', [ExperienceController::class, 'home'])->name('home');

Route::get('/tours', [ExperienceController::class, 'tours'])->name('tours');

Route::get('/cooking-classes', [CookingClassController::class, 'index'])->name('cooking-classes.index');

Route::get('cooking-classes/{id}', [CookingClassController::class, 'show'])->name('cooking-classes.show');

Route::get('/categories', [ExperienceController::class, 'categories'])->name('categories');

Route::get('/chefs', [ChefController::class, 'index'])->name('chefs.index');

Route::get('/chefs/{id}', [ChefController::class, 'show'])->name('chefs.show');

Route::get('/experience/{id}', [ExperienceController::class, 'show'])->name('experience.show');

Route::get('/book/{topic}', [BookingController::class, 'form'])->name('book');

Route::post('/book', [BookingController::class, 'submitBooking'])->name('booking.submit');

Route::post('/booking/form', [BookingController::class, 'submitBooking'])->name('booking.submit');

Route::get('/payment', [PaymentController::class, 'show'])->name('payment.form');

Route::post('/payment', [PaymentController::class, 'process'])->name('payment.process');

Route::get('/reviews', [ReviewController::class, 'index'])->name('reviews.index');

Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');

