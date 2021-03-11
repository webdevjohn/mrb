<?php 

namespace App\Repositories\CMS;

use App\Repositories\GenreRepository;
use Illuminate\Support\Str;

class CMSGenreRepository extends GenreRepository {

    public function update(int $id, array $postData) 
	{
		$postData['slug'] = str::slug($postData['genre'], '-');

		$model = $this->model->find($id);
		$model->fill($postData)->save();

		return $model;
	}

	public function store(array $postData) 	
	{
		return $this->model->create([
            'genre' => $postData['genre'],
            'slug' => str::slug($postData['genre'])
        ]);	        
	}	
}