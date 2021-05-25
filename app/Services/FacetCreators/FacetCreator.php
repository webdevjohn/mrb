<?php 

namespace App\Services\FacetCreators;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model; 
use App\Exceptions\MethodNotFoundException;
use App\Services\Factories\ModelFactory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

abstract class FacetCreator {

    protected $entityNamespace = "App\\Models\\";

    /**
     * Define the facet entities - an array of Model names (as string). 
     *
     * @return array
     */
    abstract protected function getFacetableEntities(): array;

    /**
     * Define the properties that can be facetable.
     *
     * @return array
     */
    abstract protected function getFacetableProperties(): array;

    /**
     * Apply a filter to the entity (Model).
     *
     * @param Model $entity
     * 
     * @return Collection 
     */
    abstract protected function applyFilter(Model $entity): Collection;

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
     * @param App\Services\Factories\ModelFactory $factory
     */
    public function __construct(
        protected ModelFactory $factory
    ) {}

    
    /**
     * Accepts the collection to filter the Facets by.
     *
     * @param Collection $collection
     * 
     * @return FacetCreator
     */
    public function filterBy(Collection $collection): FacetCreator
    {
        $this->collection = $collection;        

        return $this;
    }


    /**
     * Creates the Facets.
     *
     * @return void
     */
    protected function createEntityFacets()
    {    
        foreach ($this->getFacetableEntities() as $entity) {
            $this->pushToArray($entity, $this->applyFilter($this->createEntity($entity)));
        }       
    }


    /**
     * @return void
     */
    protected function createPropertyFacets()
    {
        foreach ($this->getFacetableProperties() as $model => $properties) {            
            
            foreach($properties as $property => $options) {     
            
                $filterdProperty = $this->filterProperty(
                    $this->createEntity($model), 
                    $property, 
                    $options['sortOrder'] ?? 'asc' 
                );
                
                $this->pushToArray($options['propertyNameOverride'] ?? $property, $filterdProperty);                
            }
        }            
    }


    /**     
     * @param Model $entity
     * @param string $property
     * 
     * @return Collection
     */
    protected function filterProperty(Model $entity, string $property, string $sortOrder): Collection
    {
        return $entity->select([$property, DB::raw('COUNT(id) as count')])
            ->groupBy([$property])            
            ->whereIn('id', $this->pluckIdsFromCollection())
            ->orderBy($property, $sortOrder)
            ->get();
    }


    /**
     * Factory method that creates the entity.
     * 
     * @param string $entity
     * 
     * @return Model 
     */
    protected function createEntity(string $entity): Model
    {
        return $this->factory->make($this->entityNamespace . Str::studly($entity));
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
    protected function pluckIdsFromCollection(): array
    {
        return $this->collection->pluck('id')->toArray();
    }


    /**
     * Return all facets as an array of collections.
     *
     * @param boolean $wrapper
     * @param string $wrapperName
     * 
     * @return array
     */
    public function get(bool $wrapper = null, string $wrapperName = "facets"): array
    {
        $this->createPropertyFacets();
        
        $this->createEntityFacets();

        if(! $wrapper) {
            return $this->facets;
        }

        return [$wrapperName => $this->facets];
    }


    /**
     * Checks that a given entity has a given method.
     *
     * @param Model $entity
     * @param string $method
     * 
     * @return boolean
     */
    protected function hasMethod(Model $entity, string $method): bool
    {     
        if (method_exists($entity, $method)) return true;
        throw new MethodNotFoundException($entity, $method);
    }
}
