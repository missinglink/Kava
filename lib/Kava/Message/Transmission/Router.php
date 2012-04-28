<?php

namespace Kava\Message\Transmission;

use Kava\Message\Client;
use Kava\Message;

class Router extends Broadcaster implements Client\Recipient
{
    private $proxy;
    
    public function __construct( \SplObjectStorage $storage, Client\Recipient $recipient )
    {
        parent::__construct( $storage );
        
        $this->proxy = $recipient;
    }
    
    public function message( Client\Sender $sender, Message $message )
    {
        if( $this->storage->contains( $sender ) )
        {
            return $this->proxy->receive( $sender, $message );
        }
        
        parent::receive( $sender, $message );
    }
}