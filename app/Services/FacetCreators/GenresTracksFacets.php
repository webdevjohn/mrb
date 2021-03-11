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
        return ['Artist', 'Label'];
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
        if ($this->hasMethod($entity, 'scopeFilterByTracks')) {
            return $entity->FilterByTracks($this->pluckIdsFromCollection());
        }   
    }
}
