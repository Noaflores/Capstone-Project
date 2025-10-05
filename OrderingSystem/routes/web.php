<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SalesReportController;
use App\Http\Controllers\MenuController; 
use App\Http\Controllers\UserController;
use App\Http\Controllers\StaffOrderController;


Route::middleware(['auth', 'role:staff'])->group(function () {
    Route::get('/staff/orders', [StaffOrderController::class, 'index'])->name('staff.orders');
});

Route::resource('users', UserController::class);

Route::get('/', function () {
    return Auth::check()
        ? redirect()->route('homepage')
        : redirect()->route('login');
});

Route::get('/homepage', function () {
    return view('homepage');
})->middleware(['auth', 'role:manager', 'verified'])->name('homepage');

// ✅ Protected routes
Route::middleware('auth')->group(function () {
    
    Route::get('/menu/manage', [MenuController::class, 'edit'])->name('menu.edit');

    Route::get('/menu/manage', [MenuController::class, 'index'])->name('menu.manage');

    // Menu routes
    Route::get('/menu', [MenuController::class, 'index'])->name('menu.index');

    // Show all menu items (Edit Menu page)
    Route::get('/menu/edit', [MenuController::class, 'edit'])->name('menu.edit');

    // Create new item
    Route::get('/menu/create', function () {return view('manager.create-menu');})->name('menu.create');

    Route::post('/menu/store', [MenuController::class, 'store'])->name('menu.store');

    // Show edit form for one item
    Route::get('/menu/{id}/edit', [MenuController::class, 'editItem'])->name('menu.editItem');

    // Update existing item
    Route::put('/menu/{id}', [MenuController::class, 'update'])->name('menu.update');

    // Delete existing item
    Route::delete('/menu/{id}', [MenuController::class, 'destroy'])->name('menu.destroy');

    // Sales report
    Route::get('/reports/sales', [SalesReportController::class, 'index'])->name('reports.sales');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
