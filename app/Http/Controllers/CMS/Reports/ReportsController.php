<?php

namespace App\Http\Controllers\CMS\Reports;

use App\Http\Controllers\Controller;

class ReportsController extends Controller
{    
    public function index()
    {
        return View('cms.reports.index');
    }
}
