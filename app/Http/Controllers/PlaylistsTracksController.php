<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\PlaylistWasViewed;
use App\Models\Playlist;

class PlaylistsTracksController extends Controller
{  
    /**
	 * Display all tracks for a given playlist
     *
     * @param Request $request
     * @param Playlist $playlist
     * 
     * @return Illuminate\View\View 
     */
    public function index(Request $request, Playlist $playlist)
    {
        $tracks = $playlist->tracks()->withFilters($request->input(), orderBy: 'year_released')->paginate(48);
        
        event(new PlaylistWasViewed($playlist));

        return View('playlists.tracks.index', [
            'playlist' => $playlist,
            'tracks' => $tracks
        ]);
    }
}
