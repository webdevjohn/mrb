<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Repositories\AlbumRepository;

class AlbumsTracksController extends Controller
{
    public function __construct(
        protected AlbumRepository $albums
    ){}


    /**
     * Return an album with tracks.
     *
     * @param Album $album
     */
    public function index(Album $album)
    {
        return View('albums.tracks.index', array(
            'album' => $this->albums->getAlbumTracks($album->slug),
        ));        
    }
}
