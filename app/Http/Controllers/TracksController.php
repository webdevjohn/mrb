<?php

namespace App\Http\Controllers;

use App\Events\TrackWasPlayed;
use App\Events\TrackWasViewed;
use App\Models\Track;

class TracksController extends Controller
{ 
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return void
     */
    public function show(Track $track)
    {
        event(new TrackWasViewed($track));        
    }

    /**
     * Updates the played_counter when a track is played.
     * 
     * @param Track $track 
     * @return void
     */
    public function played(Track $track)
    {
        event(new TrackWasPlayed($track));
    }
}
