<?php

namespace Kava;

use \Kava\HTTP\Concept\URLObject,
    \Kava\HTTP\Concept\Headers,
    \Kava\HTTP\Concept\BodySection;

class Request implements HTTP\Concept\Request
{
    private $url, $headers, $body;

    /**
     * Create a new request object
     * 
     * @param URLObject $url
     * @param Headers $headers
     * @param BodySection $body
     */
    public function __construct( URLObject $url, Headers $headers, BodySection $body )
    {
        $this->url     = $url;
        $this->headers = $headers;
        $this->body    = $body;
    }

    /**
     * @return URLObject
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @return Headers
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * @return BodySection
     */
    public function getBody()
    {
        return $this->body;
    }
}