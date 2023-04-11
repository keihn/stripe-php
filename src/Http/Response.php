<?php 

namespace Keihn\Stripe\Http;

class Response
{
    public string $body = '';
    public function __construct()
    {

    }

    public function setBody($data): void
    {
        $this->body = $data;
    }
}