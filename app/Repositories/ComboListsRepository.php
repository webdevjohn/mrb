<?php 

namespace App\Repositories;

use App\Services\Factories\ModelFactory;

class ComboListsRepository {

	public function __construct(
		protected ModelFactory $modelFactory
	){}
	
	protected function mergeCollection($collection = [])
	{
		$pleaseSelect [0] = 'Please Select....';
		return array_replace($pleaseSelect, $collection);
	}

	public function getList($model, $field, $merge = true, $keyField = 'id')
	{
		$list = $this->modelFactory->make($model)->orderBy($field)->pluck($field, $keyField)->toArray();
		
		if ($merge) {
			return $this->mergeCollection($list);
		}
		
		return $list;
	}	
}
