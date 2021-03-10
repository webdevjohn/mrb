<?php

namespace App\Models\Filters\Common;

use Webdevjohn\Filterable\Interfaces\FilterableInterface;

class FormatFilter implements FilterableInterface
{
	/**
	 * Filters the model by format. 
	 *
	 * @param $query
	 * @param int $formatId
	 * 
	 * @return void
	 */
	public function filter($query, $formatId)
	{
       	$query->where('format_id', $formatId); 
	}
}
