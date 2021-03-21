<?php

namespace App\Http\Controllers;

use App\Models\Playlist;

class PlaylistsController extends Controller
{    
    public function __construct(
        protected Playlist $playlists
    ){}

    /**
     * Display a listing of the resource.
     *
     * @return Illuminate\View\View 
     */
    public function index()
    {
        return View('playlists.index', array(
            'playlists' => $this->playlists->paginate(24)
        ));
    }
}
