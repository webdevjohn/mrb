<?php 

namespace App\Services\Basket;

use Illuminate\Session\Store;

abstract class Basket {
	 
	/**
	 * Implement the function to set the $sessionKey;
	 *
	 * @return void
	 */
	abstract protected function setSessionKey();

	
	/**
	 * Session handler.
	 *
	 * @var Illuminate\Session\Store
	 */
	protected $session;
	

	/**
	 * The unique key for the session.
	 *
	 * @var string
	 */
	protected $sessionKey;


	/**
	 * Create a new Basket.
	 *
	 * @param Illuminate\Session\Store $session
	 */
    public function __construct(Store $session)
    {    		
		$this->session = $session;
		$this->setSessionKey();		  
    }


	/**
	 * Put an item to the basket if it doesn't already exist.
	 *
	 * @param $item
	 * 
	 * @return void
	 */
	public function addItem($item) 
	{
		if ( ! $this->hasItem($item->id))  
		{
			$this->session->push($this->sessionKey, $item);
		}
	}


	/**
	 * Removes an item from the basket.
	 *
	 * @param integer $id
	 * 
	 * @return void
	 */
	public function removeItem(int $id) 
	{	
		$items = $this->getItems();

		foreach ($items as $key=>$value) 
		{
			if ($value->id == $id) 
			{
				unset($items[$key]);
				break;
			}
		}

		$this->setItems($items);
	}
	

	/**
  	* Returns a count of the number of items in the basket.
  	*
    * @return int
    */
	public function getNumberOfItems() 
	{
		if ($this->getItems()) return count($this->getItems());
		return null;
	}
	

	/**
	 * Retrieves the items from the session.
	 *
	 * @return void
	 */	
	public function getItems() 
	{
		return $this->session->get($this->sessionKey);
	}


	/**
	 * Removes all items from the session, based on the $sessionKey
	 *
	 * @return void
	 */
	public function emptyBasket() 
	{
		$this->session->forget($this->sessionKey);
	}

	/**
	 * Returns an array of Item IDs (primary keys) for the items in the basket.
	 * Will return null if basket is empty.
	 * 
	 * @return Array|Null
	 */
	public function getItemsIDArray() 
	{
		$items = $this->getItems(); 

		if ($items != null) 
		{
			foreach ($items as $item) 
			{
				$itemIdArray[] = $item->id;
			}
			return $itemIdArray;
		}	
		return null;
	}


	/**	 
	 * Determine if the given item (by $id) exists.
	 * 
	 * @param integer $id
	 * 
	 * @return boolean
	 */
	public function hasItem(int $id) 
	{
		if ($this->getItem($id)) {
			return true;
		}
		return false;
	}


	/**
	 * Add items to the session, based on the $sessionKey.
	 *
	 * @param array $items
	 * 
	 * @return void
	 */
	protected function setItems($items = [])
	{
		$this->session->put($this->sessionKey, $items);
	}


	/**
	 * Finds and returns an Item in the session.
	 * will return null if there are no items in the session.
	 * 
	 * @param int $id
	 * 
	 * @return Array|Null
	 */
	protected function getItem(int $id) 
	{
		$items = $this->getItems();

		if (is_null($items)) return null;

		foreach ($items as $key=>$value)
		{		
			if ($value->id == $id) 
			{
				return($items[$key]);
			}
		}

	}

} // end class