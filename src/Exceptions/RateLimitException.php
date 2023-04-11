<?php

namespace Keihn\Stripe\Exceptions;


class RateLimitException extends \Exception{
    public function __construct($message)
    {
        parent::__construct($message);
    }
}