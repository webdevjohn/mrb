<?php

namespace App\View\Components\CMS;

use Illuminate\View\Component;
use Illuminate\Pagination\LengthAwarePaginator;

class Pagination extends Component
{    
    public function __construct(
        public LengthAwarePaginator $model
    ) {}

    /**
     * Get the view / contents that represents the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('cms.components.pagination');
    }
}
