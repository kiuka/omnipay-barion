<?php
namespace Omnipay\Barion\Message;
use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RedirectResponseInterface;
use Omnipay\Common\Message\RequestInterface;
/**
 * Barion Purchase Response
 */
class PurchaseResponse extends AbstractResponse implements RedirectResponseInterface
{
    protected $redirectUrl;

    public function isSuccessful()
    {
        return false;
    }

    public function isRedirect()
    {
        if (!isset($this->data['error']) || !$this->data['error']) {
            return true;
        }
    }

    public function getRedirectUrl()
    {
        if ((!isset($this->data['error']) || !$this->data['error']) && isset($this->data['GatewayUrl'])) {
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
        if (isset($this->data['message'])) {
            return $this->data['message'];
        }

        return '';
    }
}