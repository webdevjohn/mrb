<?php

namespace App\Models\Traits;

use App\Exceptions\PropertyNotFoundException;
use App\Exceptions\NotASortSubclassException;
use Illuminate\Support\Str;

trait Sortable {

	/**
	 * The default namespace of the Sort subclasses.  The $sortableNamespace
	 * can be superseded by including a $sortableNamespace property on any
	 * Model that uses the Sortable trait.  Useful for organising Sorts.
	 *
	 * @var string
	 */
    protected $sortableNamespace = '\\App\\Models\Sorts\\';


	/**
	 * Dynamically applies a data sort to the model.
	 *
	 * @param $query
	 * @param array $sort
	 * 
	 * @return void
	 */
	public function scopeSortable($query, array $sort)
    {	
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
		$class = $this->resolveSortableNamespace($className);
		
		$c = new $class();
		
		if ($this->isSortInstance($c)) return $c;	
	}


	/**
	 * Determines which namespace to prepend to the classname.
	 *
	 * @param string $className
	 * 
	 * @return $class
	 */
	protected function resolveSortableNamespace(string $className)
	{
		$className = str::studly($className);

		if (property_exists($this, 'sortableNamespace')) return $this->sortableNamespace . $className;

		return $this->sortableNamespace . $className;		
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
