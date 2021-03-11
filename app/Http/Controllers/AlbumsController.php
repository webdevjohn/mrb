<?php

namespace App\Http\Controllers;

use App\Repositories\AlbumRepository;

class AlbumsController extends Controller
{
    public function __construct(
        protected AlbumRepository $albums
    ){}

    /**
     * Display a paginated list of Albums
     *           
     */
    public function index()
    {
        return View('albums.index', array(
            'albums' => $this->albums->getAlbums()   
        ));
    }
}
