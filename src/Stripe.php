<?php

namespace Keihn\Stripe;

use Keihn\Stripe\Charges;

class Stripe{

    public Charges $charges;
    private $apikey = '';

    public function __construct(string $apikey = '')
    {
        $this->apikey = $apikey;
        $this->charges = new Charges();
    }

    public function getAPiKey(){
        return $this->apikey;
    }

}