<?php

namespace Omnipay\Elavon\Message;

use Omnipay\Elavon\Message\AbstractRequest;

/**
 * Sample Complete Authorize Response
 * The complete authorize action involves interpreting the an asynchronous response.
 * These are most commonly https POSTs to a specific URL. Also sometimes known as IPNs or Silent Posts
 *
 * The data passed to these requests is most often the content of the POST and this class is responsible for
 * interpreting it
 */
class CompleteAuthorizeRequest extends AbstractRequest
{
    public function sendData($data)
    {
        return $this->response = new CompleteAuthorizeResponse($this, $data);
    }

    public function getData()
    {
        if (strtolower($this->httpRequest->request->get('x_MD5_Hash')) !== $this->getHash()) {
            throw new InvalidRequestException('Incorrect hash');
        }

        return $this->httpRequest->request->all();
    }
}
