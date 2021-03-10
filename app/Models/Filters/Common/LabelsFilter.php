<?php

namespace App\Models\Filters\Common;

use Webdevjohn\Filterable\Interfaces\FilterableInterface;

class LabelsFilter implements FilterableInterface
{
    /**
	 * Filters the model by multiple labels.
	 *
	 * @param $query
	 * @param array $labels
	 * 
	 * @return void
	 */
	public function filter($query, $labels = [])
    {        	
    	$query->whereIn('label_id', $labels);      
    }
}
