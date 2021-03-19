<?php 

namespace App\Repositories;

use App\Models\Track;
use Illuminate\Support\Facades\DB;

class TrackRepository extends EloquentRepository {

	/**
	* @var Track
	*/
	protected $model;


	/**
	* @param Track $model
	*/
	function __construct(Track $model)
	{
		$this->model = $model;
	}


	public function getSearchableTracks($request)
	{
		return $this->model->WithRelations()
						   ->Filters($request->input())
						   ->Sortable($request->input())
						   ->orderBy('purchase_date', 'DESC')	
						   ->get();							
	}


	// Homepage
	public function popular(string $orderBy, int $take = 12)
	{
		return $this->model->WithRelations()
			->orderBy($orderBy, 'DESC')
			->take($take)
			->get();						   
	}
	

	/**
	 * Used on Genre Homepage.
	 *
	 * @param int $genreId
	 * 
	 * @return collection
	 */
	public function getPopularTracksByGenre(int $genreId, $take = 12)
	{
		return $this->model->WithRelations()							    
			->Filters(['genre' => $genreId])			
			->orderBy('played_counter', 'DESC')
			->take($take)
			->get();
	}	


	public function byPlaylist(string $slug, array $requestInput)
	{
		return $this->model->WithRelations()
			->Filters(['playlist' => $slug])
			->Filters($requestInput)
			->Sortable($requestInput)
			->paginate($this->paginateSize);							
	}


	public function getTracksYearCountByLabel(int $labelId, array $requestInput)
	{
		return $this->model
			->select('year_released', DB::raw('count(*) as year_released_count'))
			->groupBy('year_released')
			->where('label_id', $labelId)
			->Filters($requestInput)
			->get();	
	}
}
