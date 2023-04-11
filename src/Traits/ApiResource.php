<?php
namespace Keihn\Stripe\Traits;

use Keihn\Stripe\Stripe;

trait ApiResource{
    
    public function securelyRetrieveKeys(){
        $stripe = new Stripe();
        $reflectionProperty = new \ReflectionProperty(Stripe::class, 'apiKey');
        $reflectionProperty->setAccessible(true);
        $key = $reflectionProperty->getValue($stripe);
        return  $key;
    }
}