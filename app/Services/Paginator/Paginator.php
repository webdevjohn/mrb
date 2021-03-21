<?php 
namespace App\Services\Paginator;


use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class Paginator {

    public function __construct(
        protected Request $request
    ){}

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
        $currentPage = $this->request->input('page', 1);
        $offset = ($currentPage * $perPage) - $perPage;
        $itemsToShow = $collection->slice($offset, $perPage);

        return (new LengthAwarePaginator($itemsToShow, $total, $perPage))->setPath(url()->current());
    }
}
