<?php

namespace App\Models\Traits;

use Illuminate\Database\Eloquent\Builder;

trait FacetableByTracks {

    /**
     *
     * @param Builder $query
     * @param array $trackIds
     * 
     * @return Builder
     */
    public function scopeFacetableByTracks(Builder $query, array $trackIds): Builder
	{
        return $query->whereHas('tracks', function($query) use ($trackIds)
        {
            $query->whereIn('tracks.id', $trackIds);              
		});
    }
}
	