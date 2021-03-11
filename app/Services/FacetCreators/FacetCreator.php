<?php 

namespace App\Services\FacetCreators;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model; 
use App\Exceptions\MethodNotFoundException;
use App\Services\Factories\ModelFactory;
use Illuminate\Database\Eloquent\Collection;

abstract class FacetCreator {

    /**
     * Define the facet entities - an array of Models names (as string). 
     *
     * @return array
     */
    abstract protected function getFacetableEntities();

    /**
     * Apply a filter to the entity (Model).
     *
     * @param \Illuminate\Database\Eloquent\Model $entity
     * 
     * @return \Illuminate\Database\Eloquent\Collection 
     */
    abstract protected function applyFilter(\Illuminate\Database\Eloquent\Model $entity);


    /**
     * ModelFactory
     *
     * @var App\Services\Factories\ModelFactory;
     */
    protected $factory;

    /**
     * Holds an array of collections.
     *
     * @var array
     */
    protected $facets;

    /**
     * Eloquent collection.
     *
     * @var Illuminate\Database\Eloquent\Collection
     */
    protected $collection;

    /**
     * Create a new FacetCreator.
     *
     * @param ModelFactory $factory
     */
    public function __construct(ModelFactory $factory)
    {
        $this->factory = $factory;
    }

    
    /**
     * Accepts the collection to filter the Facets by.
     *
     * @param Collection $collection
     * 
     * @return array
     */
    public function filterBy(Collection $collection) :array
    {
        $this->collection = $collection;        

        $this->create();

        return $this->getFacets();
    }


    /**
     * Creates the Facets.
     *
     * @return void
     */
    public function create()
    {
        foreach ($this->getFacetableEntities() as $entity) {
            $this->pushToArray($entity, $this->createEntity($entity));
        }       
    }


    /**
     * Factory method that creates and filters the entity.
     * Returns the filtered collection.  
     * 
     * @param string $entity
     * 
     * @return \Illuminate\Database\Eloquent\Collection
     */
    protected function createEntity(string $entity)
    {
        $entity = $this->factory->make('App\\Models\\'. Str::studly($entity));

        return $this->applyFilter($entity);    
    }


    /**
     * Pushes the collection to the Facets array.
     *
     * @param string $entity
     * @param Collection $collection
     * 
     * @return void
     */
    protected function pushToArray(string $entity, Collection $collection)
    {
        $entity = Str::plural(Str::camel($entity));
        
        $this->facets[$entity] = $collection;
    }


    /**
     * Plucks the Ids from the collection.
     *
     * @return array
     */
    protected function pluckIdsFromCollection()
    {
        return $this->collection->pluck('id')->toArray();
    }


    /**
     * Return an array of collections.
     *
     * @return array 
     */
    protected function getFacets()
    {
         return $this->facets;
        return ['facets' => $this->facets];
    }


    /**
     * Checks that a given entity has a given method.
     *
     * @param Model $entity
     * @param string $method
     * 
     * @return mixed boolean|exception
     */
    protected function hasMethod(Model $entity, string $method)
    {     
        if (method_exists($entity, $method)) return true;
        throw new MethodNotFoundException($entity, $method);
    }
    
    
}