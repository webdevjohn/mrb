<?php

namespace App\Models\Filters\Track;

use Webdevjohn\Filterable\Interfaces\FilterableInterface;

class ArtistFilter implements FilterableInterface
{
	/**
	 * Filters the model by an individual artist. 
	 *
	 * @param $query
	 * @param int $artistId
	 * 
	 * @return void
	 */
	public function filter($query, $artistId)
	{
		 return $query->whereHas('artists', function($query) use ($artistId) 
		 {
        	$query->where('artist_id', $artistId); 
         });
	}
}
