<?php
namespace Omnipay\Barion\Message;

use League\Omnipay\Common\Message\AbstractResponse;
use League\Omnipay\Common\Message\RedirectResponseInterface;

class PurchaseResponse extends AbstractResponse implements RedirectResponseInterface
{
    protected $redirectUrl;

    public function isCompleted()
    {
        // TODO: Implement isCompleted() method.
    }

    public function isSuccessful()
    {
        return empty($this->data['error']);
    }

    public function isRedirect()
    {
        if (!empty($this->data['GatewayUrl'])) {
            return true;
        }
    }

    public function getRedirectUrl()
    {
        if ($this->isRedirect()) {
            return $this->data['GatewayUrl'];
        }
    }

    public function getRedirectMethod()
    {
        return 'GET';
    }

    public function getRedirectData()
    {
    }

    public function getMessage()
    {
        if (!empty($this->data['message'])) {
            return $this->data['message'];
        }

        return '';
    }
}