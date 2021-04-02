<?php

namespace App\Http\Controllers;

use App\Models\Label;

class LabelsController extends Controller
{    
    public function __construct(
        protected Label $labels
    ){}

    /**
     * Display a paginated list of record labels.
     * GET /labels
     *
     * @return Response
     */
    public function index()
    {       
        return View('labels.index', array(
            'labels' => $this->labels->withFields()->orderBy('label')->paginate(48)
        ));
    }
}
