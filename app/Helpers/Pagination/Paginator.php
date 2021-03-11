<?php 
namespace App\Helpers\Pagination;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class Paginator {


    /**
     * Paginate and return a given collection.
     *
     * @param \Illuminate\Database\Eloquent\Collection $collection 
     * @param integer $perPage
     * 
     * @return Illuminate\Pagination\LengthAwarePaginator;
     */
    public function paginate(Collection $collection, $perPage = 48)
    {
        $total = $collection->count();
        $currentPage = \Request::get('page', 1);
        $offset = ($currentPage * $perPage) - $perPage;
        $itemsToShow = $collection->slice($offset, $perPage);

        return (new LengthAwarePaginator($itemsToShow, $total, $perPage))->setPath(url()->current());
    }
}
