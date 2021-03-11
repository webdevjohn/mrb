<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Repositories\AlbumRepository;
use App\Repositories\ArtistRepository;
use App\Repositories\LabelRepository;
use App\Repositories\TrackRepository;

class HomeController extends Controller
{
    protected $tracks, $artists, $labels;

    public function __construct(TrackRepository $tracks, ArtistRepository $artists,
                                    LabelRepository $labels, AlbumRepository $albums)
    {
        $this->tracks = $tracks;
        $this->artists = $artists;
        $this->labels = $labels;
        $this->albums = $albums;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {    
        return View('cms.home.index', [
        	'page'          => 'Home',
            'trackCount'    => $this->tracks->getModelCount(),
            'artistCount'   => $this->artists->getModelCount(),
            'labelCount'    => $this->labels->getModelCount(),
            'albumCount'    => $this->albums->getModelCount()
        ]);
    }

}