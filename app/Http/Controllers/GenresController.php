<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Models\Label;

class GenresController extends Controller
{
    public function __construct(
        protected Genre $genres,
        protected Label $labels
    ){}

    
    /**
     * Display all genres.
     *
     * @return Illuminate\View\View 
     */
    public function index()
    {
        return View('genres.index', array(
            'genres' => $this->genres->withTrackCount()
        ));
    }


    /**
     * Show the genre homepage.
     * 
     * @param Genre $genre
     * 
     * @return Illuminate\View\View 
     */
    public function show(Genre $genre)
    {       
        return View('genres.show', [
			'genre' => $genre,
            'popularTracks' => $genre->tracks()->popular(take: 36)->get(),
			'labelsWithMostTracks' => $this->labels->WithTrackCount($genre->id),
        ]);
    }
}
