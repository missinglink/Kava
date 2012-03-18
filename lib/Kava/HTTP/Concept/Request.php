<?php

namespace Kava\HTTP\Concept;

interface Request
{
    public function __construct( URLObject $url, Headers $headers, BodySection $body );

    /** @return URLObject */
    public function getURL();

    /** @return Headers */
    public function getHeaders();

    /** @return Body */
    public function getBody();
}