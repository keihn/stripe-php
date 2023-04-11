<?php

namespace Keihn\Stripe;

use Keihn\Stripe\Http\Request;
use Keihn\Stripe\Traits\ApiResource;

class Charges
{
    public string $endpoint = '/charges';
    public  $apikey;

    public Request $request;

    use ApiResource;
    public function __construct()
    {
       $this->request = new Request();
       $this->apikey = $this->securelyRetrieveKeys();
       die($this->apikey);
    }

    public function make($payload)
    {
      $headers = ["Authorization : Bearer {$this->apikey}"];
      $this->request->makeRequest($this->endpoint, $this->request::METHOD_POST, $headers, $payload);  
    }

    public function test(){
      return $this->apikey;
    }
}

    