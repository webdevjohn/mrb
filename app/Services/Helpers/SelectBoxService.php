<?php 

namespace App\Services\Helpers;

use App\Services\Factories\ModelFactory;

class SelectBoxService {
	
	/**
	 *
	 * @var mixed
	 */
	protected $list;

	/**
	 * @var ModelFactory $modelFactory
	 */
	public function __construct(
		protected ModelFactory $modelFactory
	){}


	/**
	 * Create a new list from a given model with fully qualified namespace.    
	 *
	 * @param string $model
	 * 
	 * @return self
	 */
	public function createFrom(string $model) :self
	{
		$this->list = $this->modelFactory->make($model);

		return $this;
	}	


	/**
	 * Order the list by a given field.  The default sort order of 'ASC'
	 * can be overridden.
	 *
	 * @param string $orderBy
	 * @param string $sortOrder (default 'ASC')
	 * 
	 * @return self
	 */
	public function orderBy(string $orderBy, string $sortOrder = 'ASC') :self
	{
		$this->list = $this->list->orderBy($orderBy, $sortOrder);

		return $this;
	}


	/**
	 * The name of the field to display in the select box.
	 *
	 * @param string $field
	 * @param string $keyField
	 * 
	 * @return self
	 */
	public function display(string $field, string $keyField = 'id') :self
	{
		$this->list = $this->list->pluck($field, $keyField);

		return $this;
	}


	/**
	 * Returns the list as an Array.
	 * 
	 * @param boolean $placeHolder (default = true)
	 * 
	 * @return array
	 */
	public function asArray(bool $placeHolder = true, string $placeHolderText = 'Please Select....') :array
	{					
		$this->list = $this->list->toArray();

		if ($placeHolder) {		
			return $this->addPlaceHolder($this->list, $placeHolderText);
		}

		return $this->list;
	}


	/**
	 * Returns the list as JSON.
	 *
	 * @param boolean $placeHolder (default = true)
	 * 
	 * @return string (JSON)
	 */
	public function asJson(bool $placeHolder = true, string $placeHolderText = 'Please Select....') :string
	{
		$this->list = $this->list->toJson();

		if ($placeHolder) {		
			return $this->addPlaceHolder($this->list, $placeHolderText);
		}

		return $this->list;
	}


	/**
	 * Adds a placeholder to the list.
	 *
	 * @param array|string $list
	 * 
	 * @return array|string
	 */
	protected function addPlaceHolder(array|string $list, string $placeHolderText) :array|string
	{
		$placeHolder [0] = "$placeHolderText";

		if(is_string($list)) {
			$list = json_decode($list, TRUE);
			$list = array_replace($placeHolder, $list);
			return json_encode($list);
		}
	
		return array_replace($placeHolder, $list);
	}
}
