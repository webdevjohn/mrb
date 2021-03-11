<?php

namespace App\Http\Controllers;

use App\Repositories\PlaylistRepository;

class PlaylistsController extends Controller
{    
    public function __construct(
        protected PlaylistRepository $playlists
    ){}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return View('playlists.index', array(
            'playlists' => $this->playlists->getPaginated()
        ));
    }
}
