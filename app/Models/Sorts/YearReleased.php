<?php

namespace App\Models\Sorts;

class YearReleased extends SortAbstract
{
	/**
	 * Sort the model by year of release.
	 *
	 * @param $query
	 * @param string $orderBy
	 * 
	 * @return void
	 */
	public function sort($query, string $orderBy)
	{
        $query->orderBy('year_released', $orderBy);	
	}
}
