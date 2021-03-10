<?php

namespace App\Models\Filters\Common;

use Webdevjohn\Filterable\Interfaces\FilterableInterface;

class GenreFilter implements FilterableInterface
{
	/**
	 * Filters the model by genre. 
	 *
	 * @param $query
	 * @param int $genreId
	 * 
	 * @return void
	 */
	public function filter($query, $genreId)
	{	
       	$query->where('genre_id', $genreId); 	
	}
}
