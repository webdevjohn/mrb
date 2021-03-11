<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Services\Basket\TrackBasket;

class TrackBasketComposer
{
    /**
     * The Basket implementation.
     *
     * @var Basket
     */
    protected $basket;

    /**
     * Create a new Basket composer.
     *
     * @param  Basket  $basket
     * @return void
     */
    public function __construct(TrackBasket $basket)
    {     
        $this->basket = $basket;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('trackBasket', $this->basket);
    }
}
