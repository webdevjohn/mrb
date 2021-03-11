<?php

use App\Http\Controllers\Basket\TrackBasketController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Web Routes - Baskets
|--------------------------------------------------------------------------
|
*/

// Track Basket
Route::get('basket', [TrackBasketController::class, 'index'])->name('basket.index');
Route::post('basket/{id}/store', [TrackBasketController::class, 'store'])->name('basket.store');
Route::get('basket/destroy', [TrackBasketController::class, 'destroy'])->name('basket.destroy');
Route::get('basket/qty', [TrackBasketController::class, 'getBasketQty'])->name('basket.qty');
Route::post('basket/{id}/remove', [TrackBasketController::class, 'remove'])->name('basket.remove');