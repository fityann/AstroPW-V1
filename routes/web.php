<?php

use App\Http\Controllers\InvitationTemplateController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VendorController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// public catalog routes for couples
Route::get('/vendors', [VendorController::class, 'publicIndex'])->name('vendors.catalog.index');
Route::get('/vendors/{vendor}', [VendorController::class, 'show'])->name('vendors.catalog.show');

    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
        // User management CRUD
        Route::resource('users', App\Http\Controllers\UserController::class);
        // Vendor management CRUD (admin area)
        Route::prefix('admin')->name('admin.')->group(function() {
            Route::resource('vendors', App\Http\Controllers\VendorController::class);
            // Invitation templates management
            Route::resource('invitation-templates', InvitationTemplateController::class);
        });
    });

require __DIR__.'/auth.php';
