<?php

namespace App\Models\Traits;

use App\Exceptions\PropertyNotFoundException;
use App\Exceptions\NotASortSubclassException;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

trait Sortable {

	/**
	 * The default namespace of the Sort subclasses.  This can be 
	 * overridden by passing a namespace to the scopeSortable() query scope. 
	 *
	 * @var string
	 */
    protected $sortableNamespace = '\\App\\Models\Sorts\\';


	/**
	 *
	 * @param Builder $query
	 * @param array $sort
	 * @param string $namespace - override the default $sortableNamespace.
	 * 
	 * @return void
	 */
	public function scopeSortable(Builder $query, array $sort, string $namespace = null)
    {	
		$this->sortableNamespace = $namespace ?? $this->sortableNamespace;

		if ( ! empty($sort['field']) && ! empty($sort['order'] )) {				
			if ($this->isValidSortableField($sort['field'])) {
				$this->createSort($sort['field'])->sort($query, $sort['order']);
			}
		}		
    }


	/**
	 * Determines if a given field ($sortField) is a valid sortable field.
	 *
	 * @param string $sortField
	 * 
	 * @return boolean 
	 * @throws PropertyNotFoundException
	 */
	protected function isValidSortableField(string $sortField)
	{	
		if (! property_exists($this, 'sortableFields')) throw new PropertyNotFoundException($this, 'sortableFields');

		if (in_array(strtolower($sortField), array_map('strtolower', $this->sortableFields))) return true;

		return false;
	}


	/**
	 * Instantiates and returns a Sort subclass.
	 *
	 * @param string $className
	 * 
	 * @return Sort Instantiated Sort subclass 
	 */
	protected function createSort(string $className)
	{
		$class = $this->sortableNamespace . str::studly($className);
		
		$c = new $class();
		
		if ($this->isSortInstance($c)) return $c;	
	}


	/**
	 * Determines if a given class is a Sort instance. 
	 *
	 * @param $class
	 * 
	 * @return boolean
	 * @throws NotASortSubclassException
	 */
	protected function isSortInstance($class)
	{	
		if ($class instanceof \App\Models\Sorts\SortAbstract) return true;
		throw new NotASortSubclassException(get_class($class));
	}
}
