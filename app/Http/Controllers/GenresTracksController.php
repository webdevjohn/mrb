<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\Pagination\Paginator;
use App\Models\Genre;
use App\Repositories\TrackRepository;
use App\Services\FacetCreators\GenresTracksFacets;

class GenresTracksController extends Controller
{
	public function __construct(
		protected TrackRepository $tracks, 
		protected GenresTracksFacets $facets, 
		protected Paginator $paginator
	) {}


   	/**
	 * Display a listing of the resource.
	 * GET /genres/{$slug}/tracks
	 *
	 * @return Response
	 */
	public function index(Request $request, Genre $genre)
	{
		$tracks = $this->tracks->byGenre($genre->id, $request->input());

		$facets = $this->facets->filterBy($tracks); 

		$pageData = [
			'genre' => $genre,
			'genreTracks' => $this->paginator->paginate($tracks),
        ];

		return View('genres.tracks.index', array_merge($pageData, $facets));
	}
}
