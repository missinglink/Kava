<?php

namespace Kava\Store;

class InstanceStore extends \SplObjectStorage
{
    private $className;
    
    public function __construct( $className )
    {
        $this->className = $className;
    }
    
    public function attach( $object, $data = null )
    {
        if( is_a( $object, $this->className ) )
        {
            return parent::attach( $object, $data );
        }
        
        throw new \InvalidArgumentException( 'Expecting object of type: ' . $this->className );
    }
}
