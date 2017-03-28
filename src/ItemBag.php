<?php
namespace Omnipay\Barion;

use League\Omnipay\Common\ItemInterface;

class ItemBag extends \League\Omnipay\Common\ItemBag
{
	/**
	 * Add an item to the bag
	 *
	 * @see Item
	 *
	 * @param ItemInterface|array $item An existing item, or associative array of item parameters
	 */
	public function add($item)
	{
		if ($item instanceof ItemInterface) {
			$this->items[] = $item;
		} else {
			$this->items[] = new Item($item);
		}
	}
}