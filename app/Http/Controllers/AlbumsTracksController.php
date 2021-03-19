<?php

namespace App\Http\Controllers;

use App\Models\Album;
use Illuminate\Http\Request;

class AlbumsTracksController extends Controller
{
    /**
	  * Display all tracks for a given album.
      *
      * @param Album $album
      * @param Request $request

      * @return Illuminate\View\View 
      */
    public function index(Album $album, Request $request)
    {       
        return View('albums.tracks.index', array(
            'album' => $album,
            'tracks' => $album->tracks()->withRelationsAndSorted($request->input())->get()
        ));        
    }
}
