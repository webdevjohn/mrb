<?php 

namespace App\Repositories;

use App\Models\Label;

class LabelRepository extends EloquentRepository {

	/**
	* @var Label
	*/
	protected $model;


	/**
	* @param Label $model
	*/
	function __construct(Label $model)
	{
		$this->model = $model;
	}


	public function getPaginated()
	{
		return $this->model
			->has('tracks')
			->WithFields()
			->orderBy('label')
			->paginate($this->paginateSize);
	}

	// homepage
	public function withMostTracks($genre)
	{
		return $this->model->WithTrackCount($genre);									
	}
}
