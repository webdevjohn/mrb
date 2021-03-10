<?php

namespace App\Models\Filters\Track;

use Webdevjohn\Filterable\Interfaces\FilterableInterface;

class ArtistsFilter implements FilterableInterface
{
	/**
	 * Filters the model by multiple artists. 
	 *
	 * @param $query
	 * @param array $artistIds
	 * 
	 * @return void
	 */
	public function filter($query, $artistIds)
	{
		 return $query->whereHas('artists', function($query) use ($artistIds) 
		 {
        	$query->whereIn('artist_id', $artistIds); 
         });
	}
}
