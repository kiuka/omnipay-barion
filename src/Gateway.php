<?php
namespace Omnipay\Barion;

use League\Omnipay\Common\AbstractGateway;
use League\Omnipay\Common\Message\AbstractRequest;
use Omnipay\Barion\Http\GuzzleClient;
use Omnipay\Barion\Message\PurchaseRequest;

class Gateway extends AbstractGateway
{
	public function getName()
	{
		return 'Barion';
	}

	public function getDefaultParameters()
	{
		return [
			'payee'              => '',
			'posKey'             => '',
			'shopName'           => '',
			'paymentType'        => 'Immediate',
			'reservationPeriod'  => null,
			'paymentWindow'      => null,
			'guestCheckOut'      => true,
			'initiateRecurrence' => null,
			'recurrenceId'       => null,
			'fundingSources'     => null,
			'paymentRequestId'   => null,
			'payerHint'          => null,
			'redirectUrl'        => null,
			'callbackUrl'        => null,
			'transactions'       => null,
			'orderNumber'        => null,
			'shippingAddress'    => null,
			'locale'             => null,
		];
	}

    /**
     * @param array $options
     * @return AbstractRequest
     */
    public function purchase(array $options = [])
	{
		return $this->createRequest(PurchaseRequest::class, $options);
	}

    /**
     * @inheritdoc
     */
    protected function createRequest($class, array $parameters)
    {
        $obj = new $class(new GuzzleClient(), $this->httpRequest);

        return $obj->initialize(array_replace($this->getParameters(), $parameters));
    }

	/**
	 * @param $value
	 */
	public function setPayee($value)
	{
		$this->setParameter('payee', $value);
	}

	/**
	 * @return mixed
	 */
	public function getPayee()
	{
		return $this->getParameter('payee');
	}

	/**
	 * @param $value
	 */
	public function setPosKey($value)
	{
		$this->setParameter('posKey', $value);
	}

	/**
	 * @return mixed
	 */
	public function getPosKey()
	{
		return $this->getParameter('posKey');
	}

	/**
	 * @param $value
	 */
	public function setShopName($value)
	{
		$this->setParameter('shopName', $value);
	}

	/**
	 * @return mixed
	 */
	public function getShopName()
	{
		return $this->getParameter('shopName');
	}

	/**
	 * @param $value
	 */
	public function setPaymentType($value)
	{
		$this->setParameter('paymentType', $value);
	}

	/**
	 * @return mixed
	 */
	public function getPaymentType()
	{
		return $this->getParameter('paymentType');
	}

	/**
	 * @param $value
	 */
	public function setReservationPeriod($value)
	{
		$this->setParameter('reservationPeriod', $value);
	}

	/**
	 * @return mixed
	 */
	public function getReservationPeriod()
	{
		return $this->getParameter('reservationPeriod');
	}

	/**
	 * @param $value
	 */
	public function setPaymentWindow($value)
	{
		$this->setParameter('paymentWindow', $value);
	}

	/**
	 * @return mixed
	 */
	public function getPaymentWindow()
	{
		return $this->getParameter('paymentWindow');
	}

	/**
	 * @param $value
	 */
	public function setGuestCheckOut($value)
	{
		$this->setParameter('guestCheckOut', $value);
	}

	/**
	 * @return mixed
	 */
	public function getGuestCheckOut()
	{
		return $this->getParameter('guestCheckOut');
	}

	/**
	 * @param $value
	 */
	public function setInitiateRecurrence($value)
	{
		$this->setParameter('initiateRecurrence', $value);
	}

	/**
	 * @return mixed
	 */
	public function getInitiateRecurrence()
	{
		return $this->getParameter('initiateRecurrence');
	}

	/**
	 * @param $value
	 */
	public function setRecurrenceId($value)
	{
		$this->setParameter('recurrenceId', $value);
	}

	/**
	 * @return mixed
	 */
	public function getRecurrenceId()
	{
		return $this->getParameter('recurrenceId');
	}

	/**
	 * @param $value
	 */
	public function setFundingSources($value)
	{
		$this->setParameter('fundingSources', $value);
	}

	/**
	 * @return mixed
	 */
	public function getFundingSources()
	{
		return $this->getParameter('fundingSources');
	}

	/**
	 * @param $value
	 */
	public function setPaymentRequestId($value)
	{
		$this->setParameter('paymentRequestId', $value);
	}

	/**
	 * @return mixed
	 */
	public function getPaymentRequestId()
	{
		return $this->getParameter('paymentRequestId');
	}

	/**
	 * @param $value
	 */
	public function setPayerHint($value)
	{
		$this->setParameter('payerHint', $value);
	}

	/**
	 * @return mixed
	 */
	public function getPayerHint()
	{
		return $this->getParameter('payerHint');
	}

	/**
	 * @param $value
	 */
	public function setRedirectUrl($value)
	{
		$this->setParameter('redirectUrl', $value);
	}

	/**
	 * @return mixed
	 */
	public function getRedirectUrl()
	{
		return $this->getParameter('redirectUrl');
	}

	/**
	 * @param $value
	 */
	public function setCallbackUrl($value)
	{
		$this->setParameter('callbackUrl', $value);
	}

	/**
	 * @return mixed
	 */
	public function getCallbackUrl()
	{
		return $this->getParameter('callbackUrl');
	}

	/**
	 * @param $value
	 */
	public function setTransactions($value)
	{
		$this->setParameter('transactions', $value);
	}

	/**
	 * @return mixed
	 */
	public function getTransactions()
	{
		return $this->getParameter('transactions');
	}

	/**
	 * @param $value
	 */
	public function setOrderNumber($value)
	{
		$this->setParameter('orderNumber', $value);
	}

	/**
	 * @return mixed
	 */
	public function getOrderNumber()
	{
		return $this->getParameter('orderNumber');
	}

	/**
	 * @param $value
	 */
	public function setShippingAddress($value)
	{
		$this->setParameter('shippingAddress', $value);
	}

	/**
	 * @return mixed
	 */
	public function getShippingAddress()
	{
		return $this->getParameter('shippingAddress');
	}

	/**
	 * @param $value
	 */
	public function setLocale($value)
	{
		$this->setParameter('locale', $value);
	}

	/**
	 * @return mixed
	 */
	public function getLocale()
	{
		return $this->getParameter('locale');
	}
}