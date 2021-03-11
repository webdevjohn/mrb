<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\PlaylistWasViewed;
use App\Models\Playlist;
use App\Repositories\TrackRepository;

class PlaylistsTracksController extends Controller
{  
    public function __construct(
        protected TrackRepository $tracks
    ){}


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Playlist $playlist)
    {
        $playlistTracks = $this->tracks->byPlaylist($playlist->slug, $request->input());
        
        event(new PlaylistWasViewed($playlist));

        return View('playlists.tracks.index', array(
            'playlist' => $playlist,
            'playlistTracks' => $playlistTracks
        ));
    }
}
