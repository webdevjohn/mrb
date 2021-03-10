<?php

namespace App\Models\Filters\Common;

use Webdevjohn\Filterable\Interfaces\FilterableInterface;

class PurchaseDateFilter implements FilterableInterface
{
	/**
	 * Filters the model by purchase date.
	 *
	 * @param $query
	 * @param $purchaseDate
	 * 
	 * @return void
	 */
	public function filter($query, $purchaseDate)
	{
       	$query->where('purchase_date', $purchaseDate); 
	}
}
