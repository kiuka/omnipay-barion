<?php

namespace Omnipay\Barion\Message;

use League\Omnipay\Common\Exception\InvalidResponseException;
use League\Omnipay\Common\Message\AbstractRequest;
use Omnipay\Barion\ItemBag;

/**
 * Barion Purchase Request
 */
class PurchaseRequest extends AbstractRequest
{
    /**
     * @var string   supported version of API
     */
    protected $apiVersion = 'v2';

    /**
     * @var string   name of the method that starts the transaction
     */
    protected $startTransactionMethod = 'Payment/Start';

    /**
     * @var string   live host of API
     */
    protected $liveEndpoint = 'https://api.barion.com/';

    /**
     * @var string   test host of API
     */
    protected $testEndpoint = 'https://api.test.barion.com/';

    /**
     * return the post data for start payment call
     *
     * @return array
     */
    public function getData()
    {
        $data = [];

        $data['POSKey'] = $this->getPosKey();
        $data['PaymentType'] = $this->getPaymentType();

        if ($this->getReservationPeriod() !== NULL) {
            $data['ReservationPeriod'] = $this->getReservationPeriod();
        }

        if ($this->getPaymentWindow() !== NULL) {
            $data['PaymentWindow'] = $this->getPaymentWindow();
        }

        if ($this->getGuestCheckOut() !== NULL) {
            $data['GuestCheckOut'] = $this->getGuestCheckOut();
        }

        if ($this->getInitiateRecurrence() !== NULL) {
            $data['InitiateRecurrence'] = $this->getInitiateRecurrence();
        }

        if ($this->getRecurrenceId() !== NULL) {
            $data['RecurrenceId'] = $this->getRecurrenceId();
        }

        if ($this->getFundingSources() !== NULL) {
            $data['FundingSources'] = $this->getFundingSources();
        }

        if ($this->getPaymentRequestId() !== NULL) {
            $data['PaymentRequestId'] = $this->getPaymentRequestId();
        }

        if ($this->getPayerHint() !== NULL) {
            $data['PayerHint'] = $this->getPayerHint();
        }

        if ($this->getRedirectUrl() !== NULL) {
            $data['RedirectUrl'] = $this->getRedirectUrl();
        }

        if ($this->getCallbackUrl() !== NULL) {
            $data['CallbackUrl'] = $this->getCallbackUrl();
        }

        if ($this->getTransactions() !== NULL) {
            $data['Transactions'] = $this->getTransactions();
        }

        if ($this->getOrderNumber() !== NULL) {
            $data['OrderNumber'] = $this->getOrderNumber();
        }

        if ($this->getShippingAddress() !== NULL) {
            $data['ShippingAddress'] = $this->getShippingAddress();
        }

        if ($this->getLocale() !== NULL) {
            $data['Locale'] = $this->getLocale();
        }

        $transactionItems = [];

        $items = $this->getItems();

        if ($items) {
            foreach ($items as $item) {
                $transactionItems[] = [
                    'Name' => $item->getName() ?: '',
                    'Description' => $item->getDescription() ?: '-',
                    'Quantity' => $item->getQuantity() ?: '',
                    'Unit' => $item->getUnitName(),
                    'UnitPrice' => $item->getPrice() ?: '',
                    'ItemTotal' => $item->getPrice() && $item->getQuantity() ? ($item->getPrice() * $item->getQuantity()) : '',
                    'SKU' => $item->getSKU(),
                ];
            }
        }

        $data['Transactions'] = [
            [
                'POSTransactionId' => ($this->getPaymentRequestId() !== NULL ? $this->getPaymentRequestId() . '-01' : ''),
                'Payee' => $this->getPayee(),
                'Total' => $this->getAmount(),
                'Comment' => '',
                'PayeeTransactions' => [],
                'Items' => $transactionItems,
            ],
        ];

        return $data;
    }

    /**
     * return the response of the API call
     * @param array $data
     * @return PurchaseResponse
     */
    public function sendData($data)
    {
        try {
            $httpRequest = $this->httpClient->post(
                $this->getEndpoint(),
                [
                    'Content-Type' => 'application/json',
                ],
                \json_encode($data)
            );

            $httpResponse = (array) \json_decode($httpRequest->getBody()->getContents());
        } catch (\Exception $e) {
            $httpResponse = [
                'error' => true,
                'message' => $e->getMessage()];
        }

        return $this->response = new PurchaseResponse($this, $httpResponse);
    }


    /**
     * Return amount
     * @return mixed
     */
    public function getAmount()
    {
        return $this->getParameter('amount');
    }

    /**
     * Set the items in this order
     *
     * @param ItemBag|array $items An array of items in this order
     *
     * @return AbstractRequest
     */
    public function setItems($items)
    {
        if ($items && !$items instanceof ItemBag) {
            $items = new ItemBag($items);
        }

        return $this->setParameter('items', $items);
    }

    /**
     * return the host of api
     *
     * @return string
     */
    public function getEndpoint()
    {
        return ($this->getTestMode() ? $this->testEndpoint : $this->liveEndpoint) . $this->apiVersion . '/' . $this->startTransactionMethod;
    }

    /**
     * return the host of redirect url
     *
     * @return string
     */
    public function getRedirectHost()
    {
        return $this->getTestMode() ? $this->testRedirectHost : $this->liveRedirectHost;
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

    /**
     * @param $negativeAmountAllowed
     */
    public function setNegativeAmountAllowed($negativeAmountAllowed)
    {
        $this->negativeAmountAllowed = $negativeAmountAllowed;
    }
}