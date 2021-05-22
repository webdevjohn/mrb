<?php

namespace App\Models;

use App\Models\Traits\FacetableByTracks;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Artist extends Model
{
    use HasFactory, FacetableByTracks;

    /**
     * The database table used by the model.
     *
     * @var string
    */
    protected $table = "artists";
	
    /**
     * The attributes that are mass assignable.
     *
     * @var array
    */
	protected $fillable = ['artist_name', 'slug'];


    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------   
    */

    public function tracks() 
	{
		return $this->belongsToMany(Track::class, 'artist_track', 'artist_id', 'track_id');
	}

	public function userFavourites()
	{
		return $this->belongsToMany(User::class, 'favourite_artist_user', 'user_id', 'artist_id')->WithTimeStamps();
	}

    
    /*
    |--------------------------------------------------------------------------
    | Getters
    |--------------------------------------------------------------------------   
    */

    /**
	 * Returns a count of the number of records.
	 *
	 * @return int 
	 */
	public function getModelCount(): int
	{
		return $this->count();
	}


    /*
    |--------------------------------------------------------------------------
    | Query Scopes
    |--------------------------------------------------------------------------   
    */

    public function scopeWithTrackCount($query)
	{
		return $query->join('artist_track', 'artist_track.artist_id', '=', 'artists.id')
					 ->groupBy('artists.id', 'artists.artist_name', 'artists.slug')
					 ->select(['artists.id', 'artists.artist_name', 'artists.slug', DB::raw('count(*) as track_count')]);					 
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
            ->orderBy('artist_name')
            ->get(['id', 'artist_name']);
	} 
}
