<?php

namespace App\Http\Controllers;

use App\Models\Artist;

class ArtistsController extends Controller
{
    public function __construct(
        protected Artist $artists
    ){}

    /**
     * Display a paginated list of artists.
     *
     * @return Illuminate\View\View 
     */
    public function index()
    {
        return View('artists.index', array(
            'artists' => $this->artists->withTrackCount()->orderBy('artist_name')->paginate(96)
        ));
    }
}
