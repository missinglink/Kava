<?php

namespace Kava;

use Kava\Message\Client;

class Application implements Client\Recipient, Client\Sender
{ 
    public function send( Client\Recipient $recipient, Message $message )
    {
        $recipient->receive( $this, $message );
    }
    
    public function message( Client\Sender $sender, Message $message )
    {
    }
}