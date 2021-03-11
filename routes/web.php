<?php

use App\Http\Controllers\AlbumsController;
use App\Http\Controllers\AlbumsTracksController;
use App\Http\Controllers\ArtistsController;
use App\Http\Controllers\ArtistsTracksController;
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
        
    Route::get('/auth/enable-two-factor-authentication', function() { 
        return view('auth.enable-2fa');
    })
    ->name('auth.enable-2fa');
});

Route::get('/', [HomeController::class, 'index'])->name('homepage');

Route::get('albums', [AlbumsController::class, 'index'])->name('albums.index');
Route::get('albums/{album}/tracks', [AlbumsTracksController::class, 'index'])->name('albums.tracks.index');

Route::get('artists', [ArtistsController::class, 'index'])->name('artists.index');
Route::get('artists/{artist}/tracks', [ArtistsTracksController::class, 'index'])->name('artists.tracks.index');

Route::resource('genres', GenresController::class)->only(['index', 'show']);
Route::get('genres/{genre}/tracks', [GenresTracksController::class, 'index'])->name('genres.tracks.index');

Route::get('labels', [LabelsController::class, 'index'])->name('labels.index');
Route::get('labels/{label}/tracks', [LabelsTracksController::class, 'index'])->name('labels.tracks.index');

Route::get('playlists', [PlaylistsController::class, 'index'])->name('playlists.index');
Route::get('playlists/{playlist}/tracks', [PlaylistsTracksController::class, 'index'])->name('playlists.tracks.index');

Route::get('tracks', [TracksController::class, 'show'])->name('tracks.show');
Route::post('tracks/{id}/played', [TracksController::class, 'played'])->name('tracks.played');
