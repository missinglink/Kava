<?php

namespace Kava\Message\Proxy;

use Kava\Message\Client;
use Kava\Message;
use Kava\Store;

class SenderBlacklist extends Message\Transmission\Proxy implements Client\Recipient
{
    private $blacklist;
    
    public function __construct( Client\Recipient $recipient )
    {
        parent::__construct( $recipient );
        
        $this->blacklist = new Store\RecipientStore;
    }
    
    public function receive( Client\Sender $sender, Message $message )
    {
        if( !$this->blacklist->contains( $sender ) )
        {
            return $this->getProxy()->receive( $sender, $message );
        }
    }
    
    public function attach( Client\Sender $sender )
    {
        return $this->blacklist->attach( $sender );
    }
}