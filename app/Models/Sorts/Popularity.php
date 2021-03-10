<?php

namespace App\Models\Sorts;

class Popularity extends SortAbstract
{
	/**
	 * Sort the model by popularity.
	 *
	 * @param $query
	 * @param string $orderBy
	 * 
	 * @return void
	 */
	public function sort($query, string $orderBy)
	{
        $query->orderBy('played_counter', $orderBy);	
	}
}
