<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Repositories\GenreRepository;
use App\Repositories\LabelRepository;
use App\Repositories\TrackRepository;

class GenresController extends Controller
{
    public function __construct(
        protected GenreRepository $genres,
        protected TrackRepository $tracks, 
        protected LabelRepository $labels
    ){}

    
    /**
     * Display a listing of the resource for public viewing.
     * GET /genres
     *
     * @return Response
     */
    public function index()
    {
        return View('genres.index', array(
            'genres' => $this->genres->getAllWithTrackCount()
        ));
    }


    /**
     * GET genres/{genre}   
     */
    public function show(Genre $genre)
    {
        $popularTracks = $this->tracks->getPopularTracksByGenre($genre->id, 36);
        
        return View('genres.show', [
			'genre' => $genre,
            'popularTracks' => $popularTracks,	
			'labelsWithMostTracks' => $this->labels->withMostTracks($genre->id),
        ]);
    }
}
