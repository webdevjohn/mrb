<?php
namespace App\Http\Controllers;

use App\Models\Label;
use App\Models\Playlist;
use App\Models\Track;

class HomeController extends Controller
{        
    public function __construct(
       protected Playlist $playlists, 
       protected Track $tracks,
       protected Label $labels
    ){}

    /**
     * Display a listing of the resource.
     *
     * @return Illuminate\View\View 
     */
    public function index()
    {    
        return View('home.index', array(
            'playlists' => $this->playlists->popular(),
            'latestTracks' => $this->tracks->latestTracks()->get(),      
            'labelsWithMostTracks' => $this->labels->withTrackCount(),
            'popularTracks' => $this->tracks->popular()->get(), 
        ));
    }
}
