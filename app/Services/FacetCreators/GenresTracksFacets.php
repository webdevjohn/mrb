<?php 

namespace App\Services\FacetCreators;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class GenresTracksFacets extends FacetCreator {

    /**
     * Define and return the entities.
     *
     * @return array
     */
    protected function getFacetableEntities(): array
    {
        return ['artist', 'label'];
    }

    
    /**
     * Specify the properties that can be facetable.
     * e.g. Model => ['property' => ['options' => 'option value']
     *
     * @return array
     */
    protected function getFacetableProperties(): array
    {
        return ['Track' => [                           
                'year_released' => [
                    'sortOrder' => 'desc',
                    'propertyNameOverride' => "release_year"
                ]
            ]
        ];
    } 	


    /**
     * Apply a filter to the entity (Model)
     * Returns a filtered entity.
     * 
     * @param Model $entity
     * 
     * @return Collection
     */
    protected function applyFilter(Model $entity): Collection
    { 
        if ($this->hasMethod($entity, 'scopeTrackFacet')) {
            return $entity->trackFacet($this->pluckIdsFromCollection());
        }   
    }
}
