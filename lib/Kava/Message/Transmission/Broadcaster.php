<?php

namespace Kava\Message\Transmission;

use Kava\Message\Client;
use Kava\Message;

class Broadcaster implements Client\Recipient
{
    protected $storage;
    
    public function __construct( \SplObjectStorage $storage )
    {
        $this->storage = $storage;
    }
    
    public function message( Client\Sender $sender, Message $message )
    {
        foreach( $this->storage as $client )
        {
            if( $client !== $sender )
            {
                $client->message( $sender, $message );
            }
        }
    }
    
    public function setStorage( \SplObjectStorage $storage )
    {
        $this->storage = $storage;
    }
    
    public function getStorage()
    {
        return $this->storage;
    }
}