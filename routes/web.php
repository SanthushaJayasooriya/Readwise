<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\ModeratorController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReadingStatusController;
use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/books');
});

Route::get('/books', [BookController::class, 'index']);
Route::get('/books/{book}', [BookController::class, 'show']);

Route::middleware('auth')->group(function () {

    Route::post(
        '/books/{book}/reviews',
        [ReviewController::class, 'store']
    );

    Route::post(
        '/books/{book}/favorite',
        [FavoriteController::class, 'store']
    );

    Route::delete(
        '/books/{book}/favorite',
        [FavoriteController::class, 'destroy']
    );

    Route::get(
        '/my-favorites',
        [FavoriteController::class, 'index']
    );

    Route::post(
        '/books/{book}/status',
        [ReadingStatusController::class, 'store']
    );

    Route::get(
        '/my-reading-list',
        [ReadingStatusController::class, 'index']
    );

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});

Route::middleware(['auth', 'moderator'])->group(function () {

    Route::get(
        '/moderator/reviews',
        [ModeratorController::class, 'pendingReviews']
    );

    Route::post(
        '/moderator/reviews/{review}/approve',
        [ModeratorController::class, 'approve']
    );

    Route::post(
        '/moderator/reviews/{review}/reject',
        [ModeratorController::class, 'reject']
    );
});

Route::middleware(['auth', 'admin'])->group(function () {

    Route::get(
        '/dashboard',
        [DashboardController::class, 'index']
    )->name('dashboard');

    Route::get('/books/create', [BookController::class, 'create']);
    Route::post('/books', [BookController::class, 'store']);

    Route::get('/books/{book}/edit', [BookController::class, 'edit']);
    Route::put('/books/{book}', [BookController::class, 'update']);
    Route::delete('/books/{book}', [BookController::class, 'destroy']);

    Route::get(
        '/admin/users',
        [AdminController::class, 'users']
    );

    Route::post(
        '/admin/users/{user}/promote',
        [AdminController::class, 'makeModerator']
    );

    Route::post(
        '/admin/users/{user}/demote',
        [AdminController::class, 'removeModerator']
    );
});

require __DIR__.'/auth.php';