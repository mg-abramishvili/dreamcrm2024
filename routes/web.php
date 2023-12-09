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

    // SETTINGS
    Route::get('settings', [App\Http\Controllers\MainSettingController::class, 'index']);
    Route::put('settings', [App\Http\Controllers\MainSettingController::class, 'update']);

    // CALCULATIONS
    Route::get('calculations', [App\Http\Controllers\CalculationController::class, 'index']);
    Route::post('calculations', [App\Http\Controllers\CalculationController::class, 'store']);
    Route::get('calculation/{id}', [App\Http\Controllers\CalculationController::class, 'calculation']);

    // CATALOG BOXES
    Route::get('catalog-boxes', [App\Http\Controllers\CatalogBoxController::class, 'index']);
    Route::get('catalog-box/{id}', [App\Http\Controllers\CatalogBoxController::class, 'box']);

    // CATALOG CATEGORIES
    Route::get('catalog-categories', [App\Http\Controllers\CatalogCategoryController::class, 'index']);
    Route::get('catalog-category/{id}', [App\Http\Controllers\CatalogCategoryController::class, 'category']);

    // CATALOG ITEMS
    Route::get('catalog-item/{id}', [App\Http\Controllers\CatalogItemController::class, 'item']);

    // STOCK CATEGORIES
    Route::get('stock-categories', [App\Http\Controllers\StockCategoryController::class, 'index']);
    Route::get('stock-category/{id}', [App\Http\Controllers\StockCategoryController::class, 'category']);

    // STOCK ITEMS
    Route::get('stock-items', [App\Http\Controllers\StockItemController::class, 'index']);
    Route::post('stock-items', [App\Http\Controllers\StockItemController::class, 'store']);
    Route::get('stock-item/{id}', [App\Http\Controllers\StockItemController::class, 'item']);
    Route::put('stock-item/{id}/update', [App\Http\Controllers\StockItemController::class, 'update']);

    // STOCK BALANCES
    Route::get('stock-item/{id}/balances', [App\Http\Controllers\StockBalanceController::class, 'stockItemBalances']);
    Route::post('stock-balances', [App\Http\Controllers\StockBalanceController::class, 'store']);
    Route::get('stock-balance/{id}', [App\Http\Controllers\StockBalanceController::class, 'balance']);
    Route::put('stock-balance/{id}/update', [App\Http\Controllers\StockBalanceController::class, 'update']);

    // USERS
    Route::get('users', [App\Http\Controllers\UserController::class, 'index']);
    Route::get('user/{id}', [App\Http\Controllers\UserController::class, 'user']);

    // TEST
    Route::get('test', [App\Http\Controllers\CatalogItemController::class, 'autoUpdatePrices']);
    Route::get('test2', [App\Http\Controllers\CatalogBoxController::class, 'autoUpdatePrices']);
});

Route::get('{any}', function () {
    return view('app');
})->where('any', '.*')->middleware('auth');
