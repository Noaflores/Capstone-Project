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

// ================= MANAGER ROUTES =================
Route::middleware(['auth', 'role:manager'])->group(function () {

    Route::get('/homepage', fn () => view('homepage'))->name('homepage');

    // ✅ User management (manager & staff)
    Route::resource('users', UserController::class)
        ->except(['create', 'store', 'show']);

    // Menu management (Manager only)
Route::prefix('menu')->name('menu.')->middleware(['auth', 'role:manager'])->group(function () {

    // Check if sub-category exists (AJAX)
    Route::get('/check-sub-category/{id}', [MenuController::class, 'checkSubCategory'])
        ->name('checkSubCategory');

    // Manage menu items page
    Route::get('/manage', [MenuController::class, 'index'])
        ->name('manage');

    // Create menu item
    Route::get('/create', [MenuController::class, 'create'])
        ->name('create');
    Route::post('/store', [MenuController::class, 'store'])
        ->name('store');

    // Edit menu item
    Route::get('/{id}/edit', [MenuController::class, 'editItem'])
        ->name('editItem'); // <-- this is the exact name your blade uses

    // Update menu item
    Route::put('/{id}', [MenuController::class, 'update'])
        ->name('update');

    // Delete menu item
    Route::delete('/{id}', [MenuController::class, 'destroy'])
        ->name('destroy');
});

    // Reports
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
