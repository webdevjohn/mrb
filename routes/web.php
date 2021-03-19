<?php

use App\Http\Controllers\AlbumsController;
use App\Http\Controllers\AlbumsTracksController;
use App\Http\Controllers\ArtistsController;
use App\Http\Controllers\ArtistsTracksController;
use App\Http\Controllers\Basket\TrackBasketController;
use App\Http\Controllers\GenresController;
use App\Http\Controllers\GenresTracksController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LabelsController;
use App\Http\Controllers\LabelsTracksController;
use App\Http\Controllers\PlaylistsController;
use App\Http\Controllers\PlaylistsTracksController;
use App\Http\Controllers\TracksController;
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

// Auth routes
Route::middleware(['auth', 'verified'])->group(function () {
    
    Route::get('/dashboard')->middleware(['auth', 'dashboard.redirector'])->name('dashboard');

    Route::get('/auth/enable-two-factor-authentication', function() { 
        return view('auth.enable-2fa');
    })
    ->name('auth.enable-2fa');
});

Route::get('/', [HomeController::class, 'index'])->name('homepage');

Route::get('albums', [AlbumsController::class, 'index'])->name('albums.index');
Route::get('albums/{album}/tracks', [AlbumsTracksController::class, 'index'])->name('albums.tracks.index');

Route::get('artists', [ArtistsController::class, 'index'])->name('artists.index');
Route::get('artists/{artist:slug}/tracks', [ArtistsTracksController::class, 'index'])->name('artists.tracks.index');

Route::resource('genres', GenresController::class)->only(['index', 'show'])->scoped(['genre' => 'slug',]);
Route::get('genres/{genre:slug}/tracks', [GenresTracksController::class, 'index'])->name('genres.tracks.index');

Route::get('labels', [LabelsController::class, 'index'])->name('labels.index');
Route::get('labels/{label:slug}/tracks', [LabelsTracksController::class, 'index'])->name('labels.tracks.index');

Route::get('playlists', [PlaylistsController::class, 'index'])->name('playlists.index');
Route::get('playlists/{playlist:slug}/tracks', [PlaylistsTracksController::class, 'index'])->name('playlists.tracks.index');

Route::get('tracks/{track}', [TracksController::class, 'show'])->name('tracks.show');
Route::post('tracks/{id}/played', [TracksController::class, 'played'])->name('tracks.played');


/*
|--------------------------------------------------------------------------
| Track Basket
|--------------------------------------------------------------------------
|
*/
Route::prefix('basket')->group(function () {
   
    // Track Basket
    Route::get('basket', [TrackBasketController::class, 'index'])->name('basket.index');
    Route::post('basket/{id}/store', [TrackBasketController::class, 'store'])->name('basket.store');
    Route::get('basket/destroy', [TrackBasketController::class, 'destroy'])->name('basket.destroy');
    Route::get('basket/qty', [TrackBasketController::class, 'getBasketQty'])->name('basket.qty');
    Route::post('basket/{id}/remove', [TrackBasketController::class, 'remove'])->name('basket.remove');
});


/*
|--------------------------------------------------------------------------
| Admin CMS Routes
|--------------------------------------------------------------------------
*/
Route::prefix('cms')->name('cms.')->middleware(['auth', 'verified', 'roles.administrator'])->group(function () {

    Route::get('/home', [App\Http\Controllers\CMS\HomeController::class, 'index'])
        ->name('homepage');

    Route::get('tracks/by-year-purchased/{year}', [
        App\Http\Controllers\CMS\TracksController::class, 'getTracksByYearPurchased'
    ])->name('tracks.by-year-purchased');

    Route::resource('albums', App\Http\Controllers\CMS\Albums\AlbumsController::class);
    Route::resource('albums.tracks', App\Http\Controllers\CMS\Albums\Tracks\TracksController::class);
    Route::resource('artists', App\Http\Controllers\CMS\ArtistsController::class)->scoped([
        'artist' => 'slug',
    ]);
    Route::resource('formats', App\Http\Controllers\CMS\FormatsController::class);
    Route::resource('genres', App\Http\Controllers\CMS\GenresController::class)->scoped([
        'genre' => 'slug',
    ]);
    Route::resource('key-codes', App\Http\Controllers\CMS\KeyCodesController::class);
    Route::resource('labels', App\Http\Controllers\CMS\LabelsController::class)->scoped([
        'label' => 'slug',
    ]);
    Route::resource('playlists', App\Http\Controllers\CMS\Playlists\PlaylistsController::class)->scoped([
        'playlist' => 'slug',
    ]);
    Route::resource('playlists.tracks', App\Http\Controllers\CMS\Playlists\Tracks\TracksController::class)->scoped([
        'playlist' => 'slug',
    ]);
    Route::resource('tags', App\Http\Controllers\CMS\TagsController::class);
    Route::resource('tracks', App\Http\Controllers\CMS\TracksController::class);
});
