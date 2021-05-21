<?php

namespace App\Models\FilterComponents;

use Webdevjohn\Filterable\Interfaces\FilterComponentInterface;

class TrackFilterComponent implements FilterComponentInterface {
    
    /**
	 * The namespace of the instantiable Filter classes.
	 * 
	 * @return string
	 */	
	public function getInstantiableFiltersNamespace(): string
	{
		return 'App\\Models\\Filters\\Track';
    }
	
	
    /**
	 * A safe list of filters that are allowed to be applied to the model. 
	 * 
	 * The names on the list correspond to a query string parameter name. 
	 * Each of the names on the list are used to dynamically build and 
	 * instantiate the Filter classes. 
	 * 
	 * For example, the query string parmenter "year_released" will instantiate 
	 * the "YearReleasedFilter" class and apply it to the model.	
	 * 
	 * 
	 * @return array
	 */
	public function getInstantiableFilters(): array
	{
		return ['artists'];
	}


    /**
	 * The namespace of the common instantiable Filter classes.
	 * 
	 * @return string
	 */	
	public function getInstantiableCommonFiltersNamespace(): string
	{
		return 'App\\Models\\Filters\\Common';
    }

	
	/**
	 * A safe list of common filters that are allowed to be applied to the model. 
	 *
	 * @return array
	 */
	public function getInstantiableCommonFilters(): array
	{
		return ['genre', 'labels', 'years_released'];
	}

	
    /**
	 * Filter the model from a filter contained within the IOC container, 
	 * specifying the name (as string) for each binding within the IOC container.
	 *
	 * @return array
	 */
	public function getIOCFilters() :array 
	{
		return [];
	}
}
