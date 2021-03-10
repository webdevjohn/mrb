<?php

namespace App\Models\Filters\Common;

use Webdevjohn\Filterable\Interfaces\FilterableInterface;

class LabelFilter implements FilterableInterface
{
	/**
	 * Filters the model by an individual label.
	 *
	 * @param $query
	 * @param int $labelId
	 * 
	 * @return void
	 */
	public function filter($query, $labelId)
    {        	
    	$query->where('label_id', $labelId);      
    }
}
