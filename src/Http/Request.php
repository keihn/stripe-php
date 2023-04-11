<?php

namespace Keihn\Stripe\Http;

use Keihn\Stripe\Http\Contracts\HttpClientInterface;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Keihn\Stripe\Exceptions\ApiErrorException;

/**
 * Summary of Request
 */
class Request implements HttpClientInterface
{

    
    public $channel;
    public Response $response;
    
    public string $method = '';
    public bool $sslDisabled = true;
    public const METHOD_GET = 'get';
    public const METHOD_POST = 'post';
    public array $defaultHeaders = [];

    public $base = 'https://api.stripe.com/v1';

    public function __construct()
    {
        $this->channel = $this->loadChannel();
    }

    public function makeRequest($endpoint, $method, $headers = array(), $payload)
    {
        $url = $this->base . $endpoint;
        $response = $this->buildRequest($url, $method, $headers, $payload, $this->channel)->run();
        return $response;
    }


    public function buildRequest(string $url, string $method, Array $headers = [], Array $payload, $channel)
    {
        \curl_setopt($channel, CURLOPT_URL, $url);
        (empty($headers)) ? $headers = $this::getDefaultHeaders() : $headers = array_merge($this::getDefaultHeaders(), $headers);

        if($this->isPostMethod($method)){
            \curl_setopt($channel, CURLOPT_POST, true);
            \curl_setopt($channel, CURLOPT_PUT, true);
        }
   
        \curl_setopt($channel, CURLOPT_POSTFIELDS, $payload);
        \curl_setopt($channel, CURLOPT_HTTPHEADER, $headers);
        \curl_setopt($channel, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        \curl_setopt($channel, CURLOPT_RETURNTRANSFER, true);

        if(Request::sslCheckDisbled()){
            \curl_setopt($channel, CURLOPT_SSL_VERIFYPEER, false);
        }

        return $this;
    }

    public function loadChannel()
    {
        return \curl_init();
    }

    public function run(){
        $res = curl_exec($this->channel);
        \curl_close($this->channel);
        if($res === false){
            throw new ApiErrorException("Error Processing Request");
        }
        return $res; 
    }


    public function setMethod(string $method)
    {
        $this->method = $method;
    }

    protected static function getDefaultHeaders()
    {

        $ua = [
            'bindings_version' => '10.12.0',
            'lang' => 'php',
            'lang_version' => \PHP_VERSION,
            'publisher' => 'stripe',
        ];

        $userAgentJson = \json_encode($ua);

        return Request::$defaultHeaders = [
            "X-Stripe-Client-User-Agent : {$userAgentJson}",
            "Accept : */*",
            "Content-Type : application/x-www-form-urlencoded ",
        ];;
    }

    public static function sslCheckDisbled(): bool
    {
        return Request::$sslDisabled;
    }

    public function isGetMethod(string $method)
    {
        return (strtolower($method) === Request::METHOD_GET);
    }
    public function isPostMethod(string $method)
    {
        return (strtolower($method) === Request::METHOD_POST);
    }

}



