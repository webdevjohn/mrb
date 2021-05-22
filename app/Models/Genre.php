<?php

namespace App\Models;

use App\Models\Traits\FacetableByTracks;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Genre extends Model
{
    use HasFactory, FacetableByTracks;

    /**
     * The database table used by the model.
     *
     * @var string
    */
 	protected $table = 'genres';

 	/**
     * The attributes that are mass assignable.
     *
     * @var array
    */
	protected $fillable = ['genre', 'slug', 'colour_code'];
	

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------   
    */

    public function albums() 
	{
		return $this->hasMany(Album::class, 'genre_id');
	}

	public function tracks() 
	{
		return $this->hasMany(Track::class, 'genre_id');
	}
    
    
    /*
    |--------------------------------------------------------------------------
    | Query Scopes
    |--------------------------------------------------------------------------   
    */

    public function scopeWithTrackCount(Builder $query): Builder
	{
		return $query->join('tracks', 'tracks.genre_id', '=', 'genres.id')
			->groupBy('genres.id', 'genres.genre', 'genres.slug', 'genres.colour_code')			
			->select([
				'genres.id', 
				'genres.genre', 
				'genres.slug', 
				'genres.colour_code',
				DB::raw('count(*) as track_count'), 
				DB::raw('sum(tracks.purchase_price) as genre_cost')
			]);
						
	}

	public function scopeByYearPurchased(Builder $query, int $year = 2018): Builder
	{
		return $query->where(DB::raw('YEAR(purchase_date)'), $year);	
	}
	
	/**
	 *
	 * @param Builder $query
	 * @param array $trackIds
	 * 
	 * @return Collection
	 */
	public function scopeTrackFacet(Builder $query, array $trackIds): Collection
	{
		return $query->facetableByTracks($trackIds)
			->orderBy('genre')
			->get(['id', 'genre']);
	} 
}
