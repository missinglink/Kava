<?php

namespace Kava\HTTP\Concept;

interface Gateway
{
    /**
     * Maps gateway specific variables to an HttpRequest object.
     * 
     * @param $request \HttpRequest
     * @return \HttpRequest
     */
    public function update( \HttpRequest $request );
}