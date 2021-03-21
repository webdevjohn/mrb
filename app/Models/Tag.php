<?php

namespace App\Models;

use App\Models\Traits\FacetableByTracks;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory, FacetableByTracks;

        /**
     * The database table used by the model.
     *
     * @var string
    */
    protected $table = 'tags';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
    */
	protected $fillable = ['tag'];


    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------   
    */

    public function tracks() 
    {
        return $this->belongsToMany(Track::class, 'tag_track', 'tag_id', 'track_id');
    }


    /*
    |--------------------------------------------------------------------------
    | Query Scopes
    |--------------------------------------------------------------------------   
    */
    
    /**
	 *
	 * @param Builder $query
	 * @param array $trackIds
	 * 
	 * @return Collection
	 */
	public function scopeTrackFacet(Builder $query, array $trackIds): Collection
	{
		return $query->facetableByTracks($trackIds)->orderBy('tag')->get();
	} 
}
