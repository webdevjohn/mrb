<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Http\ViewComposers\PageHelpersComposer;

class PageHelpersComposerServiceProvider extends ServiceProvider
{
    /**
     * The pages which the trackBasket should be injected.
     *
     * @var array
     */
    protected $pageHelpersPages = [
        'track-search.results',
        'cms.albums.create',
        'cms.albums.edit',
        'cms.playlists.create',
        'cms.playlists.edit'
    ];



    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer($this->pageHelpersPages, PageHelpersComposer::class);
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
