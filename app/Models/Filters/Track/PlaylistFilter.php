<?php

namespace App\Models\Filters\Track;

use Webdevjohn\Filterable\Interfaces\FilterableInterface;

class PlaylistFilter implements FilterableInterface
{
	/**
	 * Filters the model by an individual artist. 
	 *
	 * @param $query
	 * @param int $artistId
	 * 
	 * @return void
	 */
	public function filter($query, $slug)
	{
        return $query->whereHas('playlists', function($query) use ($slug) 
        {
            $query->where('slug', $slug); 
        });
	}
}
