<?php 

namespace App\Services\FacetCreators;

class TrackSearchFacets extends FacetCreator {

    /**
     * Define and return the entities.
     *
     * @return array
     */
    protected function getFacetableEntities()
    {
        return ['Format', 'Genre', 'Label'];        
    }


    /**
     * Return the name of the base entity.
     *
     * @return string
     */
    protected function getBaseEntity()
    {
        return 'Track';
    }


    /**
     * Sometimes you need to create facets based upon the value of
     * fields on the base entity (e.g. a year of release).  
     * 
     * Populate the array to return a list of method names that correspond
     * to query scopes on the base entity (Model).  Each method will be invoked
     * dynamically to create the facets.
     * 
     *
     * @return array
     */
    protected function getBaseEntityFacets()
    {
        return ['ReleaseYears'];
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
        return $entity->FilterByTracks($this->pluckIdsFromCollection());  
    }

 }