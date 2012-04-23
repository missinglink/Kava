<?php

namespace Kava\Message\Proxy;

use Kava\Message\Client;
use Kava\Message;
use Kava\Store;

class MessageClassWhitelist extends Message\Transmission\Proxy implements Client\Recipient
{
    private $whitelist;
    
    public function receive( Client\Sender $sender, Message $message )
    {
        foreach( $this->whitelist as $className )
        {
            if( is_a( $message, $className ) )
            {
                return $this->getProxy()->receive( $sender, $message );
            }
        }
    }
    
    public function enqueue( $class )
    {
        $this->whitelist = $this->whitelist ?: new \SplQueue; 
        
        return $this->whitelist->enqueue( $class );
    }
}