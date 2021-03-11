<?php 

namespace App\Repositories;

use App\Models\Artist;

class ArtistRepository extends EloquentRepository {
	
	/**
	* @var Artist
	*/
	protected $model;

	/**
	* @param Artist $model
	*/
	function __construct(Artist $model)
	{
		$this->model = $model;
	}

	public function getAllWithTrackCount(int $take = 96)
	{
		return $this->model->WithTrackCount()->orderBy('artist_name')->paginate($take);
	}
}
