<?php
namespace App\Http\Controllers;

use App\Models\Label;
use Illuminate\Http\Request;
use App\Repositories\PlaylistRepository;
use App\Repositories\TrackRepository;

class HomeController extends Controller
{        
    public function __construct(
       protected PlaylistRepository $playlists, 
       protected TrackRepository $tracks,
       protected Label $labels
    ){}

    /**
     * Display a listing of the resource.
     *
     * @return Illuminate\View\View 
     */
    public function index(Request $request)
    {    
        return View('home.index', array(
            'playlists' => $this->playlists->popular(),
            'latestTracks' => $this->tracks->popular(orderBy: 'purchase_date'),      
            'labelsWithMostTracks' => $this->labels->WithTrackCount($request->genre),
            'popularTracks' => $this->tracks->popular(orderBy: 'played_counter'), 
        ));
    }
}
