<?php 

namespace App\Repositories;

use App\Models\Tag;

class TagRepository extends EloquentRepository {

	/**
	* @var Tag
	*/
	protected $model;

	/**
	* @param Tag $model
	*/
	function __construct(Tag $model)
	{
		$this->model = $model;
	}
}
