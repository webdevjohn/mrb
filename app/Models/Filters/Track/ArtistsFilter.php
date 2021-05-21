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
	public function filter($query, $artists)
	{
		$artistIds = $this->removePrefix($artists);

		return $query->whereHas('artists', function($query) use ($artistIds) 
		{
			$query->whereIn('artist_id', $artistIds); 
		});
	}


	/**	 
	 * @param array $artists
	 * 
	 * @return array
	 */
	public function removePrefix(array $artists): array
	{
		return collect($artists)->map(function ($artist) {
			return str_replace("artist-","", $artist);
		})->toArray();
	}
}
