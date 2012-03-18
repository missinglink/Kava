<?php

namespace Kava\HTTP\Concept;

interface BodySection
{
    /** @param mixed $body */
    public function __construct( $body );

    /** @return string */
    public function __toString();
}