<?php

namespace App\Listeners;

use App\Events\TrackWasPlayed;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UpdateTrackWasPlayedCounter
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
     * @param  TrackWasPlayed  $event
     * @return void
     */
    public function handle(TrackWasPlayed $event)
    {
        $event->track()->incPlayedCounter()->save();
    }
}
