<?php
namespace Omnipay\Elavon; //Make sure you update the namespace to reflect your plugin

use Omnipay\Common\AbstractGateway;

/**
 * Sample Gateway using a redirect method
 */
class Gateway extends AbstractGateway
{

    /**
     * get the name of your processor. This will be the name used w
     * @return string
     */
    public function getName()
    {
        return 'Elavon';
    }

    /**
     * declare the parameters that will be used to authenticate with the site
     * You will need to create a function for each of these. e.g getUsername for username
     * @return array
     */
    public function getDefaultParameters()
    {
        return array(
            'username' => '',
            'password' => '',
            'testMode' => false,
        );
    }

    /**
     *
     * @param array $parameters
     * @return \Omnipay\Elavon\Message\AuthorizeRequest
     */
    public function authorize(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Elavon\Message\AuthorizeRequest', $parameters);
    }

    /**
     *
     * @param array $parameters
     * @return \Omnipay\Elavon\Message\CaptureRequest
     */
    public function capture(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Elavon\Message\CaptureRequest', $parameters);
    }

    /**
     *
     * @param array $parameters
     * @return \Omnipay\Elavon\Message\PurchaseRequest
     */
    public function purchase(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Elavon\Message\PurchaseRequest', $parameters);
    }

    /**
     *
     * @param array $parameters
     * @return \Omnipay\Elavon\Message\CompletePurchaseRequest
     */
    public function completePurchase(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Elavon\Message\CompletePurchaseRequest', $parameters);
    }

    /**
     * @param array $parameters
     * @return \Omnipay\Elavon\Message\CompleteAuthorizeRequest
     */
    public function completeAuthorize(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Elavon\Message\CompleteAuthorizeRequest', $parameters);
    }

    public function getUsername()
    {
        return $this->getParameter('username');
    }

    public function setUsername($value)
    {
        return $this->setParameter('username', $value);
    }

    public function getPassword()
    {
        return $this->getParameter('password');
    }

    public function setPassword($value)
    {
        return $this->setParameter('password', $value);
    }
}
