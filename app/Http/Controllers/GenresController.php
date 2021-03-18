<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Models\Label;
use App\Repositories\TrackRepository;

class GenresController extends Controller
{
    public function __construct(
        protected Genre $genres,
        protected TrackRepository $tracks, 
        protected Label $labels
    ){}

    
    /**
     * Display a listing of the resource for public viewing.
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
     *
     * @param Genre $genre
     * 
     * @return Illuminate\View\View 
     */
    public function show(Genre $genre)
    {
        $popularTracks = $this->tracks->getPopularTracksByGenre($genre->id, 36);
        
        return View('genres.show', [
			'genre' => $genre,
            'popularTracks' => $popularTracks,	
			'labelsWithMostTracks' => $this->labels->WithTrackCount($genre->id),
        ]);
    }
}
