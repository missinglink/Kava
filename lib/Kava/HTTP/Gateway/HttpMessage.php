<?php

namespace Kava\HTTP\Gateway;

use \Kava\HTTP\Concept\Gateway;

class HttpMessage implements Gateway
{
    private $message;
    
    /**
     * Create a gateway mapper based on any HttpMessage object
     * 
     * @param \HttpMessage $message 
     */
    public function __construct( \HttpMessage $message )
    {        
        $this->message = $message;
    }
    
    /**
     * Maps environmental variables to an HttpRequest object.
     * 
     * @param $request \HttpRequest
     * @return \HttpRequest 
     */
    public function update( \HttpRequest $request )
    {        
        // Create a new URL from message data
        $request->setUrl( \Kava\HTTP\URL::factory(
            $this->message->getRequestUrl(),
            new \ArrayObject( $this->message->getHeaders() )
        ));
        
        // Map message data to Request
        $request->setMethodFromName( $this->message->getRequestMethod() );
        $request->setHeaders( new \ArrayObject( $this->message->getHeaders() ) );
        $request->setBody( $this->message->getBody() );
    }
}