<?php

namespace Kava\HTTP\Concept;

interface URLString
{
    /**
     * Create a new URL model
     *
     * @param string $url
     * @example http://username:password@hostname/path?arg=value#anchor
     */
    public function __construct( $url );

    /**
     * Get the assembled URL as a string
     *
     * @return string
     * @example 'http://username:password@hostname/path?arg=value#anchor'
     */
    public function __toString();
}