<?php 

namespace App\Repositories\CMS;

use App\Repositories\LabelRepository;
use Illuminate\Support\Str;

class CMSLabelRepository extends LabelRepository {

    public function update(int $id, array $postData) 
	{
		$postData['slug'] = str::slug($postData['label'], '-');
		$model = $this->model->find($id);     

		$model->fill($postData)->save();     
		
		return $model;
	}


	public function store(array $postData) 	
	{
		$postData['slug'] = str::slug($postData['label'], '-');
		return $this->model->create($postData);	        
	}


	public function getLabels()
	{
		return $this->model
					->WithFields()
					->orderBy('label')
					->paginate($this->paginateSize);
	}


	
}