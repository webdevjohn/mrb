<?php

namespace App\View\Components\CMS;

use Illuminate\View\Component;

class FormValidationErrors extends Component
{
    /**
     * Get the view / contents that represents the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('cms.components.form-validation-errors');
    }
}
