<?php 

namespace App\Repositories;

use App\Models\Playlist;

class PlaylistRepository extends EloquentRepository {

	/**
	* @var Playlist
	*/
	protected $model;

	/**
	* @param Playlist $model
	*/
	function __construct(Playlist $model)
	{
		$this->model = $model;
	}

	// homepage
	public function popular(int $take = 4)
	{
		return $this->model
			->orderBy('viewed_counter', 'DESC')
			->take($take)
			->get();
	}
}
