<?php 

namespace App\Repositories;

use App\Models\Format;

class FormatRepository extends EloquentRepository {

	/**
	* @var Format
	*/
	protected $model;

	/**
	* @param Format $model
	*/
	function __construct(Format $model)
	{
		$this->model = $model;
	}
}
