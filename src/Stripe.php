<?php

namespace Keihn\Stripe;

use Keihn\Stripe\Charges;

class Stripe{

    public Charges $charges;
    private $apiKey = '';

    public function __construct(string $apiKey = '')
    {
        $this->apiKey = $apiKey;
        $this->charges = new Charges($this->apiKey);
    }

    public function getapiKey(){
        return $this->apiKey;
    }

}