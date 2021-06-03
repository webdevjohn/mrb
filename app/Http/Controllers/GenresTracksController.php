<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Genre;
use App\Services\FacetCreators\GenresTracksFacets;
use App\Services\Paginator\Paginator;

class GenresTracksController extends Controller
{
	public function __construct(
		protected GenresTracksFacets $facets, 
		protected Paginator $paginator
	) {}


   	/**
	 * Display all tracks for a given genre.
	 *
     * @return Illuminate\View\View 
	 */
	public function index(Request $request, Genre $genre)
	{	
		if ( $request->ajax() ) {
			
			$tracks = $genre->tracks()->withFilters($request->input())->get();

			return View('genres.tracks.modals.facets', array_merge([
				'genre' => $genre, 
				'trackCount' => count($tracks)], 
				$this->facets->filterBy($tracks)->get()
			));
		}

		return View('genres.tracks.index', [
			'genre' => $genre,
			'tracks' => $genre->tracks()->withFilters($request->input())->paginate(48)
        ]);
	}
}
