<?php

namespace App\Models\Traits\Track;

use App\Models\Track;
use Illuminate\Support\Facades\DB;

trait AdminCMSQueries {

	/**
	 * Persist a newly created track to the database.
	 *
	 * @param array $postData
	 * 
	 * @return Track
	 */
	public function store(array $postData) :Track
	{
		$track = $this->create($postData);
		$track->artists()->attach($postData['artists']);
		
		if (isset($postData['tags'])) {
			$track->tags()->attach($postData['tags']);
		}

		return $track;
	}

	/**
	 * Update an existing track.
	 * 
	 * @param Track $track
	 * @param array $postData
	 * 
	 * @return Track
	 */
	public function amend(Track $track, array $postData) :Track
	{
		$track->fill($postData)->save();
		
		$track->artists()->sync($postData['artists']);	
		
		$track->tags()->detach();
		
		if (isset($postData['tags'])) {	
			$track->tags()->attach($postData['tags']);
		}

		return $track;
	}


    public function getTracks(array $requestInput)
	{
		return $this->WithRelations()
			->Filters($requestInput)
			->Sortable($requestInput)
			->orderBy('purchase_date', 'DESC')
			->paginate($this->paginateSize);			
	}

	public function getArtistIds()
	{
		return $this->artists->pluck('id')->toArray();
	}

	public function getTagIds()
	{
		return $this->tags->pluck('id')->toArray();
	}

    /*
    |--------------------------------------------------------------------------
    | CMS - Dashboard Homepage - Chart Data
    |--------------------------------------------------------------------------   
    */

	public function getTracksByYearPurchased($year)
	{
		return $this->select(DB::raw('DATE_FORMAT(purchase_date,"%M") as month'), DB::raw('COUNT(id) as track_count'))
			->groupBy('month')
			->whereNull('album_id')
			->orderBy('purchase_date')
			->where(DB::raw('YEAR(purchase_date)'), '=', $year)
			->get();
	}
}