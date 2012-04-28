<?php

namespace Kava\Message\Proxy;

use Kava\Message\Client;
use Kava\Message;
use Kava\Store;

class SenderWhitelist extends Message\Transmission\Proxy implements Client\Recipient
{
    private $whitelist;
    
    public function __construct( Client\Recipient $recipient )
    {
        parent::__construct( $recipient );
        
        $this->whitelist = new Store\RecipientStore;
    }
    
    public function message( Client\Sender $sender, Message $message )
    {
        if( $this->whitelist->contains( $sender ) )
        {
            return $this->getProxy()->message( $sender, $message );
        }
    }
    
    public function attach( Client\Sender $sender )
    {
        return $this->whitelist->attach( $sender );
    }
}