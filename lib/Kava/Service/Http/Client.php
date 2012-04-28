<?php

namespace Kava\Service\Http;

use Kava\Message;
use Kava\Service;

class Client implements Service
{
    public function message( Message $message )
    {
        var_dump( $message );
    }
    
    public function request( $url )
    {
        return 'REQUEST: ' . $url;
    }
}