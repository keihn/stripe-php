<?php

namespace Keihn\Stripe\Http;

use Keihn\Stripe\Charges;
use Keihn\Stripe\Http\Request;


class Stripe
{

    public Request $request;
    public Response $response;
    public Charges $charges;
    protected $sk = '';

    public $obj = null;

    public const BASE_URL = "https://api.stripe.com";
    public function __construct($secret_key)
    {
        // $this->request = new Request($this->sk);
        $this->sk = $secret_key;
        $this->charges = new Charges();
        $this->response = new Response();
        $this->request = new Request();
    }

    public function __call($class, $args)
    {
        if(class_exists($class)){
            $this->obj = new $class();
            return $this->obj;
        }
    }



    public function instance()
    {
        return $this->obj;
    }

    public function authorize($secret_key) : Stripe
    {
        $this->sk = $secret_key;
        $this->loadSecretPerRequest($secret_key);
        return $this;
    }

    public function loadSecretPerRequest($key)
    {
        $this->request->setSecret($key);
    }

    public function getResponse() : string
    {
        return $this->response->body;
    }

    protected function attemptGuzzle()
    {

    }

    protected function attentCurl(){

    }


    public function get(){
        return 'get';
    }
    // Stripe->authorize()->charge();

    // Stripe->authorize->transaction();
    // Stripe->authorize->customer();
    // Stripe->authorize->charge();

}