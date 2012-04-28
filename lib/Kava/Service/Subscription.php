<?php

namespace Kava\Service;

use Kava\Message;
use Kava\Service;

class Subscription implements Message
{
    private $key;
    private $service;
    
    /**
     * Create a new subscription message
     * 
     * @param string $key
     * @param Service $service 
     */
    public function __construct( $key, Service $service )
    {        
        $this->key = $key;
        $this->service = $service;
    }
    
    /** @return string */
    public function getKey()
    {
        return $this->key;
    }

    /** @param string $key */
    public function setKey( $key )
    {
        $this->key = $key;
    }
    
    /** @return Service */
    public function getService()
    {
        return $this->service;
    }

    public function setService( Service $service )
    {
        $this->service = $service;
    }
}