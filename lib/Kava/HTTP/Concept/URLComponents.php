<?php

namespace Kava\HTTP\Concept;

interface URLComponents
{
    /**
     * @return string
     * @example '/about'
     */
    public function getPath();

    /**
     * @return string
     * @param 'bob'
     */
    public function setPath( $path );

    /**
     * @return string
     * @example 'foo=bar&bar=baz'
     */
    public function getQuery();

    /**
     * @return string
     * @param 'bob'
     */
    public function setQuery( $query );
}