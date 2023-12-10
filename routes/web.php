<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

require __DIR__.'/auth.php';

Route::prefix("api")->middleware('auth')->group(function() {
    // CRON
    Route::get('usd-update', [App\Http\Controllers\MainSettingController::class, 'autoUpdateUsdKurs']);
    Route::get('boxes-price-update', [App\Http\Controllers\CatalogItemController::class, 'autoUpdatePrices']);
    Route::get('catalog-items-price-update', [App\Http\Controllers\CatalogBoxController::class, 'autoUpdatePrices']);

    // AUTH
    Route::get('whoami', function () {
        return Auth::user()->load('permissions');
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
    Route::put('user/{id}/update', [App\Http\Controllers\UserController::class, 'update']);
    Route::put('user/{id}/permissions-update', [App\Http\Controllers\UserController::class, 'updatePermissions']);
});

Route::get('{any}', function () {
    return view('app');
})->where('any', '.*')->middleware('auth');
