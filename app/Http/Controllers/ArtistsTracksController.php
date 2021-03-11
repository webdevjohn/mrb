<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use Illuminate\Http\Request;
use App\Repositories\TrackRepository;

class ArtistsTracksController extends Controller
{
    public function __construct(
        protected TrackRepository $tracks
    ){}

    /**
     * Display a listing of the resource.
     * GET /artists/{artistSlug)/tracks
     *
     * @return Response
     */
    public function index(Request $request, Artist $artist)
    {
        return View('artists.tracks.index', array(
            'artist' => $artist,
            'artistTracks' => $this->tracks->byArtist($artist->id, $request->input()),
        ));
    }
}
