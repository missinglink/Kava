<?php

namespace Kava\Message\Transmission;

use Kava\Message\Assertion;
use Kava\Message\Client;
use Kava\Message;

abstract class Proxy
{
    private $proxy;
    
    public function __construct( Client\Recipient $recipient )
    {
        $this->proxy = $recipient;
    }
    
    public function getProxy()
    {
        return $this->proxy;
    }
    
    public function setProxy( Client\Recipient $recipient )
    {
        $this->proxy = $recipient;
    }
}