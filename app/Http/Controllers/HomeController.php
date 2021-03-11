<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\PlaylistRepository;
use App\Repositories\TrackRepository;
use App\Repositories\LabelRepository;

class HomeController extends Controller
{        
    public function __construct(
       protected PlaylistRepository $playlists, 
       protected TrackRepository $tracks,
       protected LabelRepository $labels
    ){}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {    
        return View('home.index', array(
            'playlists' => $this->playlists->popular(),
            'latestTracks' => $this->tracks->popular(orderBy: 'purchase_date'),      
            'labelsWithMostTracks' => $this->labels->withMostTracks($request->genre),
            'popularTracks' => $this->tracks->popular(orderBy: 'played_counter'), 
        ));
    }
}
