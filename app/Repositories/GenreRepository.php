<?php 

namespace App\Repositories;

use App\Models\Genre;

class GenreRepository extends EloquentRepository {

	/**
	* @var Genre
	*/
	protected $model;

	/**
	* @param Genre $model
	*/
	function __construct(Genre $model)
	{
		$this->model = $model;
	}


	public function getAllWithTrackCount()
	{
		return $this->model->WithTrackCount();
	}
}
