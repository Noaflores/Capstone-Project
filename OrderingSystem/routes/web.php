<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SalesReportController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StaffOrderController;
use App\Http\Controllers\CustomerController;

// Redirect root
Route::get('/', function () {
    return Auth::check()
        ? redirect()->route('homepage')
        : redirect()->route('login');
});

// ================= MANAGER ROUTES =================
Route::middleware(['auth', 'role:manager'])->group(function () {

    Route::get('/homepage', fn () => view('homepage'))->name('homepage');

    // User management
    Route::resource('users', UserController::class)
        ->except(['create', 'store', 'show']);

    // Menu management
    Route::prefix('menu')->name('menu.')->group(function () {
        Route::get('/check-sub-category/{id}', [MenuController::class, 'checkSubCategory'])->name('checkSubCategory');
        Route::get('/manage', [MenuController::class, 'index'])->name('manage');
        Route::get('/create', [MenuController::class, 'create'])->name('create');
        Route::post('/store', [MenuController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [MenuController::class, 'editItem'])->name('editItem');
        Route::put('/{id}', [MenuController::class, 'update'])->name('update');
        Route::delete('/{id}', [MenuController::class, 'destroy'])->name('destroy');
    });

    // Delete customer (outside menu prefix)
    Route::delete('/customers/{customer}', [CustomerController::class, 'destroy'])
        ->name('customers.destroy');

    // Sales & reports
    Route::get('/reports/sales', [SalesReportController::class, 'index'])->name('reports.sales');
    Route::get('/sales-report', [SalesReportController::class, 'index'])->name('sales.report');
    Route::get('/sales-report/pdf', [SalesReportController::class, 'downloadPDF'])->name('reports.sales.pdf');
});



// ================= STAFF ROUTES =================
Route::middleware(['auth', 'role:staff'])->group(function () {
    Route::get('/staff/orders', [StaffOrderController::class, 'index'])->name('staff.orders');
    Route::get('/staff/orders/{id}/edit-status', [StaffOrderController::class, 'editStatus'])->name('staff.orders.editStatus');
    Route::put('/staff/orders/{id}/update-status', [StaffOrderController::class, 'updateStatus'])->name('staff.orders.updateStatus');
    Route::post('/staff/orders/{id}/finish', [StaffOrderController::class, 'finish'])->name('staff.orders.finish');
});

// ================= PROFILE =================
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
