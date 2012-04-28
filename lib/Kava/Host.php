<?php

namespace Kava;

use Kava\Message\Client;

class Host implements Client\Recipient, Client\Sender
{
    public $id;
    
    public function __construct( $id )
    {
        $this->id = $id;
    }
      
    public function send( Client\Recipient $recipient, Message $message )
    {
        var_dump( 'SEND FROM: ' . $this->getInfo( $this ) . ' TO ' . $this->getInfo( $recipient ) );
        var_dump( $message );
        
        $this->message( $recipient->message( $this, $message ) );
    }
    
    public function message( Client\Sender $sender, Message $message )
    {
        var_dump( 'RECIEVE FROM: ' . $this->getInfo( $sender ) . ' TO ' . $this->getInfo( $this ) );
        var_dump( $message );
    }
    
    private function getInfo( $client )
    {
        return isset( $client->id ) ? $client->id : get_class( $client );
    }
}