<?php

namespace App\Exception;

use Throwable;

class PaymentException extends \RuntimeException
{
    public function __construct(string $message = "", int $code = 402, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
