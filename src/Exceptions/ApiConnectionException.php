<?php

namespace Keihn\Stripe\Exceptions;


class ApiConnectionException extends \Exception{
    public function __construct($message)
    {
        parent::__construct($message);
    }
}