<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Models\Album;
use App\Models\Artist;
use App\Models\Genre;
use App\Models\Label;
use App\Models\Track;

class DashboardController extends Controller
{
    public function __construct(
        protected Track $tracks, 
        protected Artist $artists,
        protected Label $labels, 
        protected Album $albums,
        protected Genre $genres
    ){}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {    
        return View('cms.dashboard', [
            'trackCount' => $this->tracks->getModelCount(),
            'artistCount' => $this->artists->getModelCount(),
            'labelCount' => $this->labels->getModelCount(),
            'albumCount' => $this->albums->getModelCount(),
            'totalsThisYear' => $this->tracks->totalsByYear(2021)->first(),
            'totalsLastYear' => $this->tracks->totalsByYear(2020)->first()
        ]);
    }

    // admin dashboard - ajax query for charts.
    public function getGenreSummary($year = 2021)
    {
        return $this->genres->withTrackCount()
            ->byYearPurchased($year)
            ->orderBy("track_count", 'desc')
            ->get();	
    }
}
