<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ResortController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Admin\AdminResortController;
use App\Http\Controllers\AuditLogController;
use Illuminate\Support\Facades\Session;

Route::get('/language/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'lv'])) {
        Session::put('locale', $locale);
    }

    return back();
})->name('language.switch');

// Public routes
Route::get('/', [ResortController::class, 'index'])->name('resorts.index');
Route::get('/resorts/{resort}', [ResortController::class, 'show'])->name('resorts.show');

// autentificetie gadijumi
Route::middleware(['auth', 'verified'])->group(function () {
    
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Reviews
    Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');
    Route::delete('/reviews/{review}', [ReviewController::class, 'destroy'])->name('reviews.destroy');

    // Profile routes
    Route::get('/profile/settings', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile/settings', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile/settings', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/profile', [UserController::class, 'profile'])->name('profile');

    // Wishlist
    Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
    Route::post('/wishlist', [WishlistController::class, 'store'])->name('wishlist.store');
    Route::delete('/wishlist/{wishlist}', [WishlistController::class, 'destroy'])->name('wishlist.destroy');

    // Adminss
    Route::middleware(['admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('logs', [AuditLogController::class, 'index'])->name('logs');

        Route::get('resorts-trash', [AdminResortController::class, 'trash'])
            ->name('resorts.trash');

        Route::post('resorts/{id}/restore', [AdminResortController::class, 'restore'])
            ->name('resorts.restore');

        Route::get('resorts/create', [AdminResortController::class, 'create'])->name('resorts.create');
        Route::post('resorts', [AdminResortController::class, 'store'])->name('resorts.store');
        Route::resource('resorts', AdminResortController::class)->except(['create', 'store']);
    });
});

require __DIR__.'/auth.php';