<?php

namespace App\Repositories\CMS;

use App\Repositories\PlaylistRepository;
use Illuminate\Support\Str;

class CMSPlaylistRepository extends PlaylistRepository {

	/**
	 * Update a record in the database.
	 *
	 * @param int $id
	 * @param array $postData
	 * 
 	 * @return \Illuminate\Database\Eloquent\Model
	 */
    public function update(int $id, array $postData) 
	{
		$postData['slug'] = str::slug($postData['name'], '-');
		
		$model = $this->model->find($id);     
		$model->fill($postData)->save();  

		return $model;   
	}


	/**
	 * Persist the resource to database.
	 *
	 * @param array $postData
 	 * @return \Illuminate\Database\Eloquent\Model
	 */
	public function store(array $postData) 	
	{
		$postData['slug'] = str::slug($postData['name'], '-');
		return $this->model->create($postData);	        
	}


	/**
	 * Returns a Playlist with associated tracks.
	 *  
	 * @param string $slug
	 * @return \Illuminate\Database\Eloquent\Model
	 */
	public function getPlaylistTracks(string $slug)
	{
		return $this->model
					->with('Tracks.Label')	
					->where('slug', '=' , $slug)
					->firstOrFail();
	}
}
