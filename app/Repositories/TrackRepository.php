<?php 

namespace App\Repositories;

use App\Models\Track;

class TrackRepository extends EloquentRepository {

	/**
	* @var Track
	*/
	protected $model;


	/**
	* @param Track $model
	*/
	function __construct(Track $model)
	{
		$this->model = $model;
	}

	// Homepage
	public function popular(string $orderBy, int $take = 12)
	{
		return $this->model->relations()
			->orderBy($orderBy, 'DESC')
			->take($take)
			->get();						   
	}
}
