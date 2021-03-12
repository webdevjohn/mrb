<?php

namespace App\Models\Traits\Album;

use App\Models\Album;
use Illuminate\Support\Str;

trait AdminCMSQueries {

	public function store(array $postData) :Album	
	{
		$postData['slug'] = $this->createSlug($postData['title']);
		
		return $this->create($postData);	        
	}

	public function amend(Album $album, array $postData) :Album
	{
		$postData['slug'] = $this->createSlug($postData['title']);

		$album->fill($postData)->save();

		return $album;
	}

	protected function createSlug(string $field) :string
	{
		return $postData['slug'] = str::slug($field, '-');
	}

	/**
	 * Returns all Albums.
	 * 
	 */
	public function getAlbums()
	{
		return $this->orderBy('purchase_date', 'DESC')
			->paginate($this->paginateSize);
	}


	/**
	 * Returns an Album with associated tracks.
	 *  
	 * @param  string $slug 
	 */
	public function getAlbumTracks(string $slug)
	{
		return $this->with('tracks.label')
			->where('slug', '=' , $slug)
			->firstOrFail();
	}
}
