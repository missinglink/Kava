<?php

namespace Kava\HTTP;

class URL implements Concept\URLObject
{
    /** @var string $urlString **/
    protected $urlString;

    /** @var string $path **/
    protected $path;

    /** @var string $query **/
    protected $query;
    
    /**
     * @param string $url
     * @example http://username:password@hostname/path?arg=value#anchor
     */
    public function __construct( $url = null )
    {
        if( is_string( $url ) )
        {
            $this->urlString = $url;
            
            $this->parseUrl( $url );
        }
    }

    /**
     * Get the assembled URL as a string
     *
     * @return string
     * @example 'http://username:password@hostname/path?arg=value#anchor'
     */
    public function __toString()
    {
        return $this->urlString;
    }

    /**
     * @param string $url
     * @example http://username:password@hostname/path?arg=value#anchor
     */
    protected function parseUrl( $url )
    {
        if( $p = parse_url( $url ) )
        {
            $this->path  = isset( $p[ 'path' ] )  ? $p[ 'path' ]  : null;
            $this->query = isset( $p[ 'query' ] ) ? $p[ 'query' ] : null;
        }
    }

    /**
     * @return string
     * @example '/about'
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @return string
     * @param 'bob'
     */
    public function setPath( $path )
    {
        $this->path = $path;
    }

    /**
     * @return string
     * @example 'foo=bar&bar=baz'
     */
    public function getQuery()
    {
        return $this->query;
    }

    /**
     * @return string
     * @param 'bob'
     */
    public function setQuery( $query )
    {
        $this->query = $query;
    }
}