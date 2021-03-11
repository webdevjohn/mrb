<?php

namespace App\Http\Controllers;

use App\Repositories\LabelRepository;

class LabelsController extends Controller
{    
    public function __construct(
        protected LabelRepository $labels
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
