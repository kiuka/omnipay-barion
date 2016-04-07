<?php
namespace Omnipay\Barion;

class Item extends \Omnipay\Common\Item
{
	/**
	 * @param $value
	 */
	public function setUnitName($value)
	{
		$this->setParameter('unitName', $value);
	}

	/**
	 * @return mixed
	 */
	public function getUnitName()
	{
		return $this->getParameter('unitName');
	}

	/**
	 * @param $value
	 */
	public function setSKU($value)
	{
		$this->setParameter('SKU', $value);
	}

	/**
	 * @return mixed
	 */
	public function getSKU()
	{
		return $this->getParameter('SKU');
	}
}