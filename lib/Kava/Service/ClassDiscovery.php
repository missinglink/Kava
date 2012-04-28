<?php

namespace Kava\Service;

use Kava\Message;
use Kava\Service;

class ClassDiscovery implements Discovery
{
    private $className;
    
    public function __construct( $className )
    {
        $this->className = $className;
    }
    
    public function discover( Service $service )
    {
        if( is_a( $service, $this->className ) )
        {
            return $service;
        }
    }
}