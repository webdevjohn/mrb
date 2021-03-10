<?php

namespace App\Models\Filters\Track;

use Webdevjohn\Filterable\Interfaces\FilterableInterface;

class BpmFilter implements FilterableInterface
{
	/**
	 * Filters the model by BPM.
	 *
	 * @param $query
	 * @param int $bpm
	 * 
	 * @return void
	 */
	public function filter($query, $bpm)
	{
       	$query->where('bpm', $bpm); 
	}
}
