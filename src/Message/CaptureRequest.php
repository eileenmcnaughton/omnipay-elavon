<?php

namespace Omnipay\Elavon\Message;

/**
 * Capture Request
 */
class CaptureRequest extends AuthorizeRequest
{
    public function getTransactionType()
    {
        return 'capture';
    }
}
