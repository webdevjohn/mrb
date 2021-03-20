<?php
namespace App\Http\Controllers;

use App\Models\Label;
use App\Models\Playlist;
use App\Repositories\TrackRepository;

class HomeController extends Controller
{        
    public function __construct(
       protected Playlist $playlists, 
       protected TrackRepository $tracks,
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
            'latestTracks' => $this->tracks->popular(orderBy: 'purchase_date'),      
            'labelsWithMostTracks' => $this->labels->withTrackCount(),
            'popularTracks' => $this->tracks->popular(orderBy: 'played_counter'), 
        ));
    }
}
