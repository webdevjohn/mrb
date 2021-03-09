<?php

namespace App\View\Components\CMS;

use Illuminate\View\Component;

class RegisteredLayout extends Component
{
    /**
     * Get the view / contents that represents the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('layouts.cms.registered');
    }
}
