<?php

namespace Keihn\Stripe;

use Exception;
use Keihn\Stripe\Http\Request;
use Keihn\Stripe\Traits\ApiResource;

class Charges
{
    public const CHARGE = "/charges";
    
    const GET_CHARGE = "/charges/";
    public const SAVE_CHARGE = "/charges/{$id}/capture";
    public  $apikey;

    public $headers = [];

    public Request $request;

    use ApiResource;
    public function __construct(string $apiKey)
    {
       $this->request = new Request();
       $this->apikey = $apiKey;
       $this->headers[] = "Authorization : Bearer {$this->apikey}";
    }

    public function make($payload)
    {
      try {
         return $this->request->makeRequest(Charges::CHARGE, $this->request::METHOD_POST, $this->headers, $payload);
      } catch (Exception $e) {
        
      }  
    }

    public function getCharge($id)
    {
      $url = self::GET_CHARGE . $id
      return $this->request->makeRequest($url, $this->request::METHOD_POST, $this->headers, $payload);  
    }
}

    