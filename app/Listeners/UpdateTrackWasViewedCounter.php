<?php

namespace App\Listeners;

use App\Events\TrackWasViewed;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UpdateTrackWasViewedCounter
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  TrackWasViewed  $event
     * @return void
     */
    public function handle(TrackWasViewed $event)
    {
        $event->track()->incViewedCounter()->saveQuietly();
    }
}
