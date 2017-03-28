<?php
namespace Omnipay\Barion\Http;

use Psr\Http\Message\RequestInterface;

class GuzzleClient extends \League\Omnipay\Common\Http\GuzzleClient
{
    /**
     * @inheritdoc
     */
    public function sendRequest(RequestInterface $request)
    {
        return $this->guzzle->send($request, [
            'verify' => __DIR__ . '/../certs/cacert.pem'
        ]);
    }
}