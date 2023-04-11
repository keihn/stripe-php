<?php

namespace Keihn\Stripe\Exceptions;

class ApiErrorException extends \Exception{
    public function __construct($message)        
    {
        parent::__construct($message);
    }
}