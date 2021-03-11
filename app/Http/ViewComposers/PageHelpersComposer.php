<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Helpers\FormControl;

class PageHelpersComposer
{
    /**
     *
     * @var FormControl
     */
    protected $formControl;

    /**
     * Create a new Page Helpers composer.
     *
     * @param  FormControl  $formControl
     * 
     * @return void
     */
    public function __construct(FormControl $formControl)
    {     
        $this->formControl = $formControl;
    }

    
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('formControl', $this->formControl);
    }
}
