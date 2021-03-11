<?php 

namespace App\Repositories;

use App\Models\KeyCode;

class KeyCodeRepository extends EloquentRepository {

	/**
	* @var KeyCode
	*/
	protected $model;

	/**
	* @param KeyCode $model
	*/
	function __construct(KeyCode $model)
	{
		$this->model = $model;
	}
}
