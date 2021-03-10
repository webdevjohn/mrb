<?php

namespace App\Models\Filters\Track;

use Webdevjohn\Filterable\Interfaces\FilterableInterface;

class KeycodeFilter implements FilterableInterface
{
	/**
	 * Filters the model by Keycode
	 *
	 * @param $query
	 * @param int $keyCodeId
	 * 
	 * @return void
	 */
	public function filter($query, $keyCodeId)
	{
       	$query->where('key_code_id', $keyCodeId); 
	}
}
