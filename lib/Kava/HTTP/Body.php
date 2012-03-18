<?php

namespace Kava\HTTP;

class Body implements Concept\BodySection
{
    private $bodyString;

    /**
     * @param string $body
     * @example 'Hello World'
     */
    public function __construct( $body = null )
    {
        $this->bodyString = $body;
    }

    /**
     * Get the raw body as a string
     *
     * @return string
     * @example 'Hello World'
     */
    public function __toString()
    {
        return $this->bodyString;
    }
}