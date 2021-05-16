<?php

namespace App\Http\Controllers\CMS\Reports;

use App\Http\Controllers\Controller;
use App\Models\Track;

class TrackReportsController extends Controller
{    
    public function __construct(
        protected Track $tracks 
    ) {}
    
    public function byYearPurchased($year = 2017)
    {        
        return $this->tracks->byYearPurchased($year);
    }

    public function breakdownByYearPurchased()
    {        
        return $this->tracks->breakdownByYearPurchased();
    }
}
