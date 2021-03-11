<?php

namespace App\Http\Controllers;

use App\Repositories\ArtistRepository;

class ArtistsController extends Controller
{
    public function __construct(
        protected ArtistRepository $artists
    ){}

    /**
     * Display a listing of the resource for public viewing.
     * GET /artists
     *
     * @return Response
     */
    public function index()
    {
        return View('artists.index', array(
            'artists' => $this->artists->getAllWithTrackCount()
        ));
    }
}