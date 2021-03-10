<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class FilterServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('TrackFilters', function ($app) {
            return new \Webdevjohn\Filterable\FilterFactory(
                $app->make(\App\Models\FilterComponents\TrackFilterComponent::class)
            );         
        });   
        
        $this->app->bind('AlbumFilters', function ($app) {
            return new \Webdevjohn\Filterable\FilterFactory(
                $app->make(\App\Models\FilterComponents\AlbumFilterComponent::class)
            );         
        });  
    }
}
