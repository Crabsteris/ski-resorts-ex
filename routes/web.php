<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ResortController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/', [ResortController::class, 'index'])
    ->name('resorts.index');

Route::get('/resorts/{resort}', [ResortController::class, 'show'])
    ->name('resorts.show');

Route::middleware('auth')->group(function () {
    Route::post('/reviews', [ReviewController::class, 'store'])
        ->name('reviews.store');

    Route::delete('/reviews/{review}', [ReviewController::class, 'destroy'])
        ->name('reviews.destroy');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/wishlist',
        [WishlistController::class, 'index'])
        ->name('wishlist.index');

    Route::post('/wishlist',
        [WishlistController::class, 'store'])
        ->name('wishlist.store');

    Route::delete('/wishlist/{wishlist}',
        [WishlistController::class, 'destroy'])
        ->name('wishlist.destroy');

    Route::middleware(['auth'])->group(function () {
    
        Route::get('/profile', [UserController::class, 'profile'])->name('profile');

    });
    });

require __DIR__.'/auth.php';
