<?php

namespace Kava;

abstract class Wrapper implements Message
{
    private $stack;
    
    public function __construct( Message $message )
    {
        $this->stack = $message->getStack();
        $this->stack->push( $this );
    }

    /**
     * @return \SplStack 
     */
    public function getStack()
    {
        return $this->stack;
    }
}