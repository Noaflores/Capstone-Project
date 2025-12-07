<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SalesReportController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StaffOrderController;

// Redirect root
Route::get('/', function () {
    return Auth::check()
        ? redirect()->route('homepage')
        : redirect()->route('login');
});

// MANAGER ROUTES
Route::middleware(['auth', 'role:manager'])->group(function () {

    // Dashboard
    Route::get('/homepage', fn() => view('homepage'))->name('homepage');

    // User management
    Route::resource('users', UserController::class);

    // Menu management (replace your old menu routes with this block)
    Route::prefix('menu')->name('menu.')->group(function () {
        Route::get('/', [MenuController::class, 'index'])->name('index');
        Route::get('/manage', [MenuController::class, 'index'])->name('manage');
        Route::get('/create', [MenuController::class, 'create'])->name('create');
        Route::post('/store', [MenuController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [MenuController::class, 'editItem'])->name('editItem');
        Route::put('/{id}', [MenuController::class, 'update'])->name('update');
        Route::delete('/{id}', [MenuController::class, 'destroy'])->name('destroy');
    });

    // Reports
    Route::get('/reports/sales', [SalesReportController::class, 'index'])->name('reports.sales');
    Route::get('/reports/sales/pdf', [SalesReportController::class, 'downloadPDF'])->name('reports.sales.pdf');
});


// STAFF ROUTES
Route::middleware(['auth', 'role:staff'])->group(function () {
    Route::get('/staff/orders', [StaffOrderController::class, 'index'])->name('staff.orders');
    Route::get('/staff/orders/{id}/edit-status', [StaffOrderController::class, 'editStatus'])->name('staff.orders.editStatus');
    Route::put('staff/orders/{id}/update-status', [StaffOrderController::class, 'updateStatus'])->name('staff.orders.updateStatus');
    Route::delete('/staff/orders/{id}/finish', [StaffOrderController::class, 'finish'])->name('staff.orders.finish');
});

// PROFILE ROUTES (for any authenticated user)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
