<?php

namespace App\Models\Filters\Common;

use Webdevjohn\Filterable\Interfaces\FilterableInterface;

class YearsReleasedFilter implements FilterableInterface
{
	/**
	 * Filters the model by multiple years of release.
	 *
	 * @param $query
	 * @param array $yearsReleased
	 * 
	 * @return void
	 */
	public function filter($query, $yearsReleased = [])
	{
       	$query->whereIn('year_released', $yearsReleased); 
	}
}
