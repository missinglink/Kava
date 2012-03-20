<?php

namespace Kava\HTTP\Gateway;

use \Kava\HTTP\Concept\Gateway;

class WebServer extends HttpMessage implements Gateway
{
    /**
     * Create a gateway mapper based on an HttpMessage object pre-filled with
     * environmental request data.
     */
    public function __construct()
    {
        parent::__construct( \HttpMessage::fromEnv( \HttpMessage::TYPE_REQUEST ) );
    }
    
    /**
     * Maps environmental variables to an HttpRequest object.
     * 
     * @param $request \HttpRequest
     * @return \HttpRequest
     */
    public function update( \HttpRequest $request )
    {
        parent::update( $request );
        
        // Set the Request query data from global settings 
        $request->setQueryData( new \HttpQueryString( true ) );
        
        // Configure Request URL schema
        if( empty( $request->getUrl()->scheme ) )
        {
            $isSecure = !empty( $_SERVER[ 'HTTPS' ] ) && $_SERVER[ 'HTTPS' ] !== 'off';
            $request->getUrl()->scheme = $isSecure ? 'https' : 'http';
        }
    }
}