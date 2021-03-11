<?php 

namespace App\Services\Factories;

class ModelFactory {

	public function make($model)
	{
		$model = new $model;

		if ($this->isEloquentModel($model)) 
		{
			return $model;
		}

		throw new \Exception("Model creation error: " . get_class($model) . " is not an instance of \Illuminate\Database\Eloquent\Model");
	}


  	protected function isEloquentModel($model)
  	{
  		if ($model instanceof \Illuminate\Database\Eloquent\Model) {
  			return true;
  		}
  		return false;
  	}

}