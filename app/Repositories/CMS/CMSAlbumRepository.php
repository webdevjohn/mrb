<?php

namespace App\Repositories\CMS;

use App\Repositories\AlbumRepository;
use Illuminate\Support\Str;

class CMSAlbumRepository extends AlbumRepository {
	
	public function store(array $postData) 	
	{
		$postData['slug'] = str::slug($postData['title'], '-');
		return $this->model->create($postData);	        
	}

	public function update(int $id, array $postData) 
	{
		$postData['slug'] = str::slug($postData['title'], '-');

		$model = $this->model->find($id);
		$model->fill($postData)->save();

		return $model;
	}

	/**
	 * Returns all Albums.
	 * 
	 */
	public function getAlbums()
	{
		return $this->model
			->orderBy('purchase_date', 'DESC')
			->paginate($this->paginateSize);
	}


	/**
	 * Returns an Album with associated tracks.
	 *  
	 * @param  string $slug 
	 */
	public function getAlbumTracks(string $slug)
	{
		return $this->model
			->with('Tracks.Label')
			->where('slug', '=' , $slug)
			->firstOrFail();
	}
}
