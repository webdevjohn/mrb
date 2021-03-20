<?php

namespace App\Http\Controllers\Basket;

use App\Http\Controllers\Controller;

abstract class BasketController extends Controller
{
	abstract public function index();
	abstract public function addToUserFavourites();

	/**
	 * Add an item to the basket.
	 *
	 * @param integer $id
	 * 
	 * @return void
	 */
	public function store(int $id)
	{
		$item = $this->model->findOrFail($id);
		$this->basket->addItem($item);
	}


	/**
	 * Remove all items in the basket.
	 *
	 * @return void
	 */
	public function destroy()
	{
		$this->basket->emptyBasket();
		return redirect()->back(); 
	}

	/**
	 * Get the number items in the basket.
	 *
	 * @return integer|null
	 */
	public function getBasketQty(): int|null
	{
		return $this->basket->getNumberOfItems();
	}


	/**
	 * Remove an item from the basket.
	 *
	 * @param integer $id
	 * 
	 * @return void
	 */
	public function remove(int $id)
	{
		return $this->basket->removeItem($id);
	}
}
