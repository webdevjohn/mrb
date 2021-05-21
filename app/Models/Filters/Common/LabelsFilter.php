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
	public function filter($query, $labels)
    {       
    	$query->whereIn('label_id', $this->removePrefix($labels));      
    }


	/**	 
	 * @param array $artists
	 * 
	 * @return array
	 */
	public function removePrefix(array $labels): array
	{
		return collect($labels)->map(function ($labels) {
			return str_replace("label-","", $labels);
		})->toArray();
	}
}
