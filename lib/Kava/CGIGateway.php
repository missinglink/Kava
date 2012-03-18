<?php

namespace Kava;

class CGIGateway implements HTTP\Concept\Gateway
{
    /**
     * @return HTTP\Concept\Headers
     */
    public function getRequestHeaders()
    {
        $headers = new HTTP\HeadersArray;
        
        foreach( $_SERVER as $key => $value )
        {
            if( preg_match( '/^(?:HTTP_|REQUEST_)(\w+)$/D', $key, $match ) )
            {
                // Format Key
                $formattedKey = strtr( ucwords( strtolower( strtr( $match[ 1 ], '_', ' ' ) ) ), ' ', '-' );

                // Set Header
                $headers[ $formattedKey ] = $value;
            }
        }

        return $headers;
    }

    /** @return HTTP\Concept\URLObject */
    public function getRequestURL()
    {
        return new HTTP\URL( $_SERVER[ 'REQUEST_URI' ] );
    }

    /** @return HTTP\Concept\BodySection */
    public function getRequestBody()
    {
        return new HTTP\Body( trim( file_get_contents( 'php://input' ) ) );
    }
}