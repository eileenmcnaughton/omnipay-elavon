<?php

namespace Omnipay\Elavon;

use Omnipay\Tests\GatewayTestCase;
use Omnipay\Elavon\Gateway;
use Omnipay\Common\Exception\InvalidRequestException;
use Omnipay\Common\CreditCard;

class GatewayTest extends GatewayTestCase
{
    /**
     * @var Omnipay/Elavon/SystemGateway
     */
    public $gateway;

    /**
     * @var Omnipay\Common\CreditCard
     */
    public $card;

    public function setUp()
    {
        parent::setUp();

        $this->gateway = new Gateway($this->getHttpClient(), $this->getHttpRequest());
        $this->gateway->setUsername('Billy');
        $this->gateway->setPassword('really_secure');
        $this->card = new CreditCard(array('email' => 'mail@mail.com'));
    }

    public function testPurchase()
    {
        $response = $this->gateway->purchase(array('amount' => '10.00', 'currency' => 978, 'card' => $this->card))->send();
        $this->assertInstanceOf('Omnipay\Elavon\Message\AuthorizeResponse', $response);
        $this->assertFalse($response->isSuccessful());
        $this->assertTrue($response->isRedirect());
        $this->assertNotEmpty($response->getRedirectUrl());
        $this->assertSame('https://github.com?ssl_user_id=Billy&password=really_secure&type=sale&ssl_amount=10.00', $response->getRedirectUrl());
        $this->assertFalse($response->isTransparentRedirect());
    }

    public function testAuthorize()
    {
        $response = $this->gateway->authorize(array('amount' => '10.00', 'currency' => 978, 'card' => $this->card))->send();
        $this->assertInstanceOf('Omnipay\Elavon\Message\AuthorizeResponse', $response);
        $this->assertFalse($response->isSuccessful());
        $this->assertTrue($response->isRedirect());
        $this->assertNotEmpty($response->getRedirectUrl());
        $this->assertSame('https://github.com?ssl_user_id=Billy&password=really_secure&type=Authorize&ssl_amount=10.00', $response->getRedirectUrl());
        $this->assertFalse($response->isTransparentRedirect());
    }

    public function testCapture()
    {
        $response = $this->gateway->capture(array('amount' => '10.00', 'currency' => 978, 'card' => $this->card))->send();
        $this->assertInstanceOf('Omnipay\Elavon\Message\AuthorizeResponse', $response);
        $this->assertFalse($response->isSuccessful());
        $this->assertTrue($response->isRedirect());
        $this->assertNotEmpty($response->getRedirectUrl());
        $this->assertSame('https://github.com?ssl_user_id=Billy&password=really_secure&type=capture&ssl_amount=10.00', $response->getRedirectUrl());
        $this->assertFalse($response->isTransparentRedirect());
    }

    public function testCompletePurchase()
    {
        $request = $this->gateway->completePurchase(array('amount' => '10.00',));

        $this->assertInstanceOf('Omnipay\Elavon\Message\CompletePurchaseRequest', $request);
        $this->assertSame('10.00', $request->getAmount());
    }

    /**
     * @expectedException Omnipay\Common\Exception\InvalidRequestException
     */
    public function testCompletePurchaseSendMissingEmail()
    {
        $this->gateway->purchase(array('amount' => '10.00', 'currency' => 'USD', 'card' => array(
            'firstName' => 'Pokemon',
            'lastName' => 'The second',
        )))->send();
    }
}
