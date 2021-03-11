<?php

namespace App\Providers;

use App\Events\PlaylistWasViewed;
use App\Events\TrackWasPlayed;
use App\Events\TrackWasViewed;
use App\Listeners\UpdatePlaylistWasViewedCounter;
use App\Listeners\UpdateTrackWasPlayedCounter;
use App\Listeners\UpdateTrackWasViewedCounter;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        TrackWasPlayed::class => [
            UpdateTrackWasPlayedCounter::class
        ],
        TrackWasViewed::class => [
            UpdateTrackWasViewedCounter::class
        ],
        PlaylistWasViewed::class => [
            UpdatePlaylistWasViewedCounter::class
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
