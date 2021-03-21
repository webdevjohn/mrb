<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use Illuminate\Http\Request;

class ArtistsTracksController extends Controller
{
    /**
	 * Display all tracks for a given artist.
     *
     * @return Illuminate\View\View 
     */
    public function index(Request $request, Artist $artist)
    {
		$tracks = $artist->tracks()->withFilters($request->input())->paginate(48);

        return View('artists.tracks.index', array(
            'artist' => $artist,
            'artistTracks' => $tracks
        ));
    }
}
