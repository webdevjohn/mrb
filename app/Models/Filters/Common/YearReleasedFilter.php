<?php

namespace App\Models\Filters\Common;

use Webdevjohn\Filterable\Interfaces\FilterableInterface;

class YearReleasedFilter implements FilterableInterface
{
	/**
	 * Filters the model by an individual year of release.
	 *
	 * @param $query
	 * @param int $yearReleased
	 * 
	 * @return void
	 */
	public function filter($query, $yearReleased)
	{
       	$query->where('year_released', $yearReleased); 
	}
}
