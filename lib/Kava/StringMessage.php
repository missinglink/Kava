<?php

namespace Kava;

class StringMessage implements Message
{
    private $string;
    
    /** @param string $string */
    public function __construct( $string )
    {
        if( !is_string( $string ) )
        {
            throw new \InvalidArgumentException( 'Invalid String' );
        }
        
        $this->string = $string;
    }
    
    public function __toString()
    {
        return $this->string;
    }
}