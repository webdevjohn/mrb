<?php

namespace App\Http\Controllers;

use App\Models\Label;

class LabelsController extends Controller
{    
    public function __construct(
        protected Label $labels
    ){}

    /**
     * Display a listing of the resource.
     * GET /labels
     *
     * @return Response
     */
    public function index()
    {       
        return View('labels.index', array(
            'labels' => $this->labels->getPaginated()
        ));
    }
}
