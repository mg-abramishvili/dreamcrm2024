<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

require __DIR__.'/auth.php';

Route::prefix("api")->middleware('auth')->group(function() {
    // AUTH
    Route::get('whoami', function () {
        return Auth::user();
    });

    // STOCK CATEGORIES
    Route::get('stock-categories', [App\Http\Controllers\StockCategoryController::class, 'index']);
    Route::get('stock-category/{id}', [App\Http\Controllers\StockCategoryController::class, 'category']);

    // STOCK ITEMS
    Route::get('stock-item/{id}', [App\Http\Controllers\StockItemController::class, 'item']);

    // STOCK BALANCES
    Route::get('stock-item/{id}/balances', [App\Http\Controllers\StockBalanceController::class, 'stockItemBalances']);
    Route::get('stock-balance/{id}', [App\Http\Controllers\StockBalanceController::class, 'balance']);

    // USERS
    Route::get('users', [App\Http\Controllers\UserController::class, 'index']);
    Route::get('user/{id}', [App\Http\Controllers\UserController::class, 'user']);
});

Route::get('{any}', function () {
    return view('app');
})->where('any', '.*')->middleware('auth');