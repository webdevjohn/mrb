<?php

namespace App\Http\Controllers\CMS\Reports;

use App\Http\Controllers\Controller;
use App\Models\Genre;

class GenreReportsController extends Controller
{    
    public function __construct(
        protected Genre $genres
    ) {}
    
    public function breakdownByTrackPurchaseYear($year = 2021)
    { 
        return $this->genres->withTrackCount()
            ->byYearPurchased($year)
            ->orderBy("track_count", 'desc')
            ->get();	
    }
}
