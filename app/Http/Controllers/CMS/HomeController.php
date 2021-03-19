<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Models\Album;
use App\Models\Artist;
use App\Models\Label;
use App\Models\Track;

class HomeController extends Controller
{
    public function __construct(
        protected Track $tracks, 
        protected Artist $artists,
        protected Label $labels, 
        protected Album $albums
    ){}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {    
        return View('cms.home.index', [
            'trackCount' => $this->tracks->getModelCount(),
            'artistCount' => $this->artists->getModelCount(),
            'labelCount' => $this->labels->getModelCount(),
            'albumCount' => $this->albums->getModelCount()
        ]);
    }
}
