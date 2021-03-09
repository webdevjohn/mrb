<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Auth routes
Route::middleware(['auth', 'verified'])->group(function () {
        
    Route::get('/auth/enable-two-factor-authentication', function() { 
        return view('auth.enable-2fa');
    })
    ->name('auth.enable-2fa');
});
