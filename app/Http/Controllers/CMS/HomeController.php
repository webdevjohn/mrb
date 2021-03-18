<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Models\Label;
use App\Repositories\AlbumRepository;
use App\Repositories\ArtistRepository;
use App\Repositories\TrackRepository;

class HomeController extends Controller
{
    public function __construct(
        protected TrackRepository $tracks, 
        protected ArtistRepository $artists,
        protected Label $labels, 
        protected AlbumRepository $albums
    ){}

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
