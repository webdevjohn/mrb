<?php 

namespace App\Repositories\CMS;

use App\Repositories\TrackRepository;
use Illuminate\Support\Facades\DB;

class CMSTrackRepository extends TrackRepository {

	public function update(int $id, array $postData) 
	{
		$track = $this->model->find($id);
		$track->fill($postData)->save();
		
		$track->Artists()->sync($postData['artists']);	
		
		$track->Tags()->detach();
		
		if (isset($postData['tags'])) {	
			$track->Tags()->attach($postData['tags']);
		}

		return $track;
	}

	
	public function store(array $postData) 	
	{
		$track = $this->model->create($postData);	
		
		$track->Artists()->attach($postData['artists']);
		
		if (isset($postData['tags'])) {
			$track->Tags()->attach($postData['tags']);
		}
	}

	/**
	 * Returns a paginated collection of Tracks.
	 *
	 * @param	\Illuminate\Http\Request $request
 	 * @return 	\Illuminate\Pagination\LengthAwarePaginator
	 */
	public function getTracks($request)
	{
		return $this->model->WithRelations()
			->Filters($request->input())
			->Sortable($request->input())
			->orderBy('purchase_date', 'DESC')
			->paginate($this->paginateSize);			
	}


	/***************************** 
	*		  Chart Data         *
	******************************/

	public function getTracksByYearPurchased($year)
	{
		return $this->model
			->select(DB::raw('DATE_FORMAT(purchase_date,"%M") as month'), DB::raw('COUNT(id) as track_count'))
			->groupBy('month')
			->whereNull('album_id')
			->orderBy('purchase_date')
			->where(DB::raw('YEAR(purchase_date)'), '=', $year)
			->get();
	}
}
