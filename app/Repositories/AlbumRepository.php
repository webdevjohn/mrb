<?php

namespace App\Repositories;

use App\Models\Album;

class AlbumRepository extends EloquentRepository {
	
	/**
	* @var Album
	*/
	protected $model;

	/**
	* @param Album $model
	*/
	function __construct(Album $model)
	{
		$this->model = $model;
	}

	
	/**
	 * Returns all Albums.
	 * GET /albums
	 */
	public function getAlbums()
	{
		return $this->model
			->orderBy('purchase_date', 'DESC')
			->paginate($this->paginateSize);	
	}


	/**
	 * Returns an Album with associated tracks.
	 * GET /albums/{$slug}/tracks
	 *  
	 * @param  string $slug 
	 * 
	 */
	public function getAlbumTracks(string $slug)
	{
		return $this->model
			->with('Tracks.Label', 'Tracks.Genre', 'Tracks.Artists', 'Tracks.Album')	
			->where('slug', '=' , $slug)
			->firstOrFail();
	}
}
