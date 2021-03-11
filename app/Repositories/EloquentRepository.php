<?php

namespace App\Repositories;

abstract class EloquentRepository {
	
	/**
	* Eloquent model
	*/
	protected $model;

	
	/**
	 * The number of records to display in a paginated recordset.
	 *
	 * @var integer
	 */
	protected $paginateSize = 48;
	

	/**
	* @param $model
	*/
	function __construct($model)
	{
		$this->model = $model;
	}


	/**
	 * Returns a count of the number of records.
	 *
	 * @return int 
	 */
	public function getModelCount()
	{
		return $this->model->count();
	}


	/**
	 * Return all records.
	 *
	 * @return Illuminate\Database\Eloquent\Model 
	 */
	public function getAll()
	{
		return $this->model->all();
	}
	

	/**
	 * Returns a paginated collection.
	 * 
	 * @return \Illuminate\Pagination\LengthAwarePaginator
	 */
	public function getPaginated()
	{
		return $this->model->paginate($this->paginateSize);
	}


	/**
	* Fetch a record by id
	*
	* @param int $id
	*
	* @return mixed
	*/
	public function find(int $id)
	{
		return $this->model->findOrFail($id);
	}


	/**
	 * Returns an Eloquent model by slug
	 * 
	 * @param  string $slug  
	 * 
	 * @return Illuminate\Database\Eloquent\Model       
	 */
	public function findBySlug(string $slug)
	{
		return $this->model->where('slug', '=' , $slug)->firstOrFail();
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param integer $id
	 * @param array $postData
	 * 
	 * @return void
	 */
	public function update(int $id, array $postData) 
	{
		$model = $this->model->find($id);
		$model->fill($postData)->save();

		return $model;
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @param array $postData
	 * 
	 * @return Illuminate\Database\Eloquent\Model  
	 */
	public function store(array $postData) 	
	{
		return $this->model->create($postData);	
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param integer $id
	 * 
	 * @return void
	 */
	public function delete(int $id)
	{
		$model = $this->model->find($id);
		$model->delete();
	}


	/**
	 * Update multiple rows / records on a html form.
	 *
	 * @param string $fieldName
	 * @param array $postData
	 * 
	 * @return void
	 */
	public function updateMultiRows(string $fieldName, array $postData) 
	{
		foreach($postData[$fieldName] as $rowID => $value) 
		{
			if ($value) {  
    			$model = $this->model->find($rowID);
    			$model->$fieldName = $value;
    			$model->save();
    		}
		}
	}
} 
