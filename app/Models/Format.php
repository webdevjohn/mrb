<?php

namespace App\Models;

use App\Models\Traits\FacetableByTracks;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Format extends Model
{
    use HasFactory, FacetableByTracks;

    /**
     * The database table used by the model.
     *
     * @var string
    */
    protected $table = "formats";
	
    /**
     * The attributes that are mass assignable.
     *
     * @var array
    */
	protected $fillable = ['format'];


    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------   
    */

    public function albums()
	{
		return $this->hasMany(Album::class, 'format_id');
	}

	public function tracks()
	{
		return $this->hasMany(Track::class, 'format_id');
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
        return $query->facetableByTracks($trackIds)
            ->orderBy('format')
            ->get(['id', 'format']);
	}
}
