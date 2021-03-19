<?php

namespace App\Http\Controllers;

use App\Models\Album;

class AlbumsController extends Controller
{
    public function __construct(
        protected Album $albums
    ){}

    /**
     * Display a paginated list of Albums
     *
     * @return Illuminate\View\View 
     */
    public function index()
    {
        return View('albums.index', array(
            'albums' => $this->albums->orderBy('purchase_date', 'DESC')->paginate(48)	  
        ));
    }
}
