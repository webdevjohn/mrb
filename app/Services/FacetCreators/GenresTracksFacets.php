<?php 

namespace App\Services\FacetCreators;

class GenresTracksFacets extends FacetCreator {

    /**
     * Define and return the entities.
     *
     * @return array
     */
    protected function getFacetableEntities()
    {
        return ['artist', 'format', 'genre', 'label', 'tag'];
    }


    /**
     * Apply a filter to the entity (Model)
     * Returns a filtered entity.
     * 
     * @param \Illuminate\Database\Eloquent\Model $entity
     * 
     * @return \Illuminate\Database\Eloquent\Model
     */
    protected function applyFilter(\Illuminate\Database\Eloquent\Model $entity)
    { 
        if ($this->hasMethod($entity, 'scopeTrackFacet')) {
            return $entity->trackFacet($this->pluckIdsFromCollection());
        }   
    }
}
