<?php
namespace App\Http\Controllers\Basket;

use Illuminate\Auth\AuthManager;
use App\Services\Basket\TrackBasket;
use App\Repositories\TrackRepository;

class TrackBasketController extends BasketController
{
   	protected $auth, $basket, $model;

	public function __construct(AuthManager $auth, TrackBasket $basket, TrackRepository $tracks)
	{
		$this->auth = $auth;
		$this->basket = $basket;
		$this->model = $tracks;
	}


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
		$this->auth->User()->addTracksToFavourites(
			$this->basket->getItemsIDArray()
		);	

		return redirect()->back(); 
	}

}