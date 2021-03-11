<?php

namespace App\Events;

use App\Models\Track;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TrackWasPlayed
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    protected $track;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Track $track)
    {
        $this->track = $track;
    }


    public function track()
    {
        return $this->track;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        //return new PrivateChannel('channel-name');
    }
}
