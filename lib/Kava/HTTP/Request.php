<?php

namespace Kava\HTTP;

/**
 * An extension of the HttpRequest from pecl_http
 * 
 * Maintains reverse compatibilty with HttpRequest
 * 
 * Features:
 *  - URL is stored as a \Kava\HTTP\URL object
 *  - Query data is stored as a \HttpQueryString
 *  - Headers are stored as an \ArrayObject
 */
class Request extends \HttpRequest
{
    private $url;
    private $queryString;
    private $headers;

    /**
     * HttpRequest constructor
     *
     * @param URL $url
     * @param int $request_method
     * @param array $options
     */
    public function __construct( $url = null, $request_method = null, array $options = null )
    {       
        parent::__construct( null, $request_method, $options );
        
        $this->setUrl( $url );
    }
    
    /**
     * Set the HTTP method by specifying a string instead of an integer
     * 
     * @example: 'GET'
     * @param string $method
     */
    public function setMethodFromName( $methodString = 'GET' )
    {
        $methodStringConstant = '\HTTP_METH_' . strtoupper( $methodString );
        $method = defined( $methodStringConstant ) ? constant( $methodStringConstant ) : \HTTP_METH_GET;
        
        $this->setMethod( $method );
    }
    
    /** @return URL */
    public function getUrl()
    {
        return $this->url;
    }

    /** @param string|URL $url */
    public function setUrl( $url )
    {
        if( is_string( $url ) )
        {
            $this->url = URL::factory( $url );
        }
        
        else if( $url instanceof Url )
        {
            $this->url = $url;
        }
    }
    
    /** @return \HttpQueryString */
    public function getQueryData()
    {
        return $this->queryString;
    }
    
    /** @param string|HttpQueryString $queryString */
    public function setQueryData( $queryString )
    {
        if( is_string( $queryString ) || is_array( $queryString ) )
        {
            $this->queryString = new \HttpQueryString( false, $queryString );
        }
        
        else if( $queryString instanceof \HttpQueryString )
        {
            $this->queryString = $queryString;
        }
    }
    
    /** @return \ArrayObject */
    public function getHeaders()
    {
        return $this->headers;
    }
    
    /** @param array|\ArrayObject $headers */
    public function setHeaders( $headers )
    {
        if( is_array( $headers ) )
        {
            $this->headers = new \ArrayObject( $headers );
        }
        
        else if( $headers instanceof \ArrayObject )
        {
            $this->headers = $headers;
        }
    }
}