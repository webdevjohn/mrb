<?php
namespace App\Http\Controllers\Basket;

use App\Models\Track;
use Illuminate\Auth\AuthManager;
use App\Services\Basket\TrackBasket;

class TrackBasketController extends BasketController
{
	public function __construct(
		protected AuthManager $auth, 
		protected TrackBasket $basket, 
		protected Track $model
	){}


	/**
	 * View items in the basket.
	 * GET /track-basket
	 *
	 * @return void
	 */
	public function index()
	{	
		return View('baskets.track-basket.index', array(
			'items'	=> $this->basket->getItems()
		));
	}


	/**
	 * Add the items in the basket to the registered user's favourites.
	 * GET /track-basket/add-to-favourites
	 *
	 * @return void
	 */
	public function addToUserFavourites()
	{
		$this->auth->user()->addTracksToFavourites(
			$this->basket->getItemsIDArray()
		);	

		return redirect()->back(); 
	}
}
