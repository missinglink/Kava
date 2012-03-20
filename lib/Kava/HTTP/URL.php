<?php

namespace Kava\HTTP;

class URL implements Concept\Stringable
{
    public $scheme;
    public $host;
    public $port;
    public $user;
    public $pass;
    public $path;
    public $query;
    public $fragment;

    /**
     * Get the assembled URL as a stringt
     *
     * @return string
     * @example 'http://username:password@hostname:port/path?arg=value#anchor'
     */
    public function __toString()
    {
        return http_build_url( (array) $this );
    }
    
    /**
     * Parse a URL 
     * 
     * @param string $urlString
     * 
     * @example http://username:password@hostname/path?arg=value#anchor
     * @return \Kava\HTTP\URL 
     */
    public static function factory( $urlString, \ArrayObject $httpHeaders = null )
    {
        $url           = new self;
        $url->scheme   = (string) parse_url( $urlString, \PHP_URL_SCHEME );
        $url->host     = (string) parse_url( $urlString, \PHP_URL_HOST );
        $url->port     = (string) parse_url( $urlString, \PHP_URL_PORT );
        $url->user     = (string) parse_url( $urlString, \PHP_URL_USER );
        $url->pass     = (string) parse_url( $urlString, \PHP_URL_PASS );
        $url->path     = (string) parse_url( $urlString, \PHP_URL_PATH );
        $url->query    = (string) parse_url( $urlString, \PHP_URL_QUERY );
        $url->fragment = (string) parse_url( $urlString, \PHP_URL_FRAGMENT );
        
        if( empty( $url->host ) )
        {
            if( isset( $httpHeaders[ 'Host' ] ) )
            {
                $url->host = $httpHeaders[ 'Host' ];
            }
        }
        
        return $url;
    }
}