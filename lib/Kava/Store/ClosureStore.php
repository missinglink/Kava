<?php

namespace Kava\Store;

class ClosureStore extends \SplObjectStorage
{
    public function attach( $object, $data = null )
    {
        if( is_callable( $object ) )
        {
            return parent::attach( $object, $data );
        }
        
        throw new \InvalidArgumentException( 'Expecting object of type: callable' );
    }
}
