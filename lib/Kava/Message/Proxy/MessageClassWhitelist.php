<?php

namespace Kava\Message\Proxy;

use Kava\Message\Client;
use Kava\Message;
use Kava\Store;

class MessageClassWhitelist extends Message\Transmission\Proxy implements Client\Recipient
{
    private $whitelist;
    
    public function message( Client\Sender $sender, Message $message )
    {
        foreach( $this->whitelist as $className )
        {
            if( is_a( $message, $className ) )
            {
                return $this->getProxy()->message( $sender, $message );
            }
        }
    }
    
    public function enqueue( $class )
    {
        $this->whitelist = $this->whitelist ?: new \SplQueue; 
        
        return $this->whitelist->enqueue( $class );
    }
}