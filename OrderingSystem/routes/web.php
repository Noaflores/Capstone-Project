<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SalesReportController;
use App\Http\Controllers\MenuController; 
use App\Http\Controllers\UserController;
use App\Http\Controllers\StaffOrderController;

// STAFF ROUTES
Route::middleware(['auth', 'role:staff'])->group(function () {
    Route::get('/staff/orders', [StaffOrderController::class, 'index'])->name('staff.orders');
    Route::get('/staff/orders/{id}/edit-status', [StaffOrderController::class, 'editStatus'])->name('staff.orders.editStatus');    
    Route::put('/staff/orders/{id}/update-status', [StaffOrderController::class, 'updateStatus'])->name('staff.orders.updateStatus');
    Route::delete('/staff/orders/{id}/finish', [StaffOrderController::class, 'finish'])->name('staff.orders.finish');

});

// MANAGER ROUTES
Route::resource('users', UserController::class);

Route::get('/', function () {
    return Auth::check()
        ? redirect()->route('homepage')
        : redirect()->route('login');
});

Route::get('/homepage', function () {
    return view('homepage');
})->middleware(['auth', 'role:manager', 'verified'])->name('homepage');

// Protected routes
Route::middleware('auth')->group(function () {

    Route::get('/menu/manage', [MenuController::class, 'index'])->name('menu.manage');

    // Menu routes
    Route::get('/menu', [MenuController::class, 'index'])->name('menu.index');
    Route::get('/menu/edit', [MenuController::class, 'edit'])->name('menu.edit');
    Route::get('/menu/create', function () {
        return view('manager.create-menu');
    })->name('menu.create');
    Route::post('/menu/store', [MenuController::class, 'store'])->name('menu.store');
    Route::get('/menu/{id}/edit', [MenuController::class, 'editItem'])->name('menu.editItem');
    Route::put('/menu/{id}', [MenuController::class, 'update'])->name('menu.update');
    Route::delete('/menu/{id}', [MenuController::class, 'destroy'])->name('menu.destroy');

    // Sales report
    Route::get('/reports/sales', [SalesReportController::class, 'index'])->name('reports.sales');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
