<?php

namespace Kava\HTTP\Concept;

interface Gateway
{
    /** @return Headers */
    public function getRequestHeaders();

    /** @return URLObject */
    public function getRequestURL();

    /** @return BodySection */
    public function getRequestBody();
}