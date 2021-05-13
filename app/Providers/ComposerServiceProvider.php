<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Http\ViewComposers\TrackBasketComposer;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * The pages which the trackBasket should be injected.
     *
     * @var array
     */
    protected $trackBasketPages = [
        'home.index', 'artists.tracks.index', 'albums.tracks.index', 'genres.show', 'genres.tracks.index', 
            'playlists.tracks.index', 'labels.tracks.index', 'baskets.track-basket.index', 'components.track-listings'
    ];


    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer($this->trackBasketPages, TrackBasketComposer::class);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
