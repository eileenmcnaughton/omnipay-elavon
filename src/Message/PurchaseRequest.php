<?php

namespace Omnipay\Elavon\Message;

/**
 * Purchase Request
 */
class PurchaseRequest extends AuthorizeRequest
{
    public function getTransactionType()
    {
        return 'sale';
    }
}
