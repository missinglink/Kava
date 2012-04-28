<?php

namespace Kava\Service;

use Kava\Message,
    Kava\Service;

class Locator implements Service
{
    /** @var \ArrayObject */
    private $services;
    
    /**
     * Create a new service locator
     * 
     * @param \ArrayObject $storage 
     */
    public function __construct( \ArrayObject $storage = null )
    {
        $this->services = $storage ?: new \ArrayObject;
    }
    
    /**
     * Receive Service\Subscription and Service\Discovery messages.
     * 
     * @param Message $message
     * @return Message
     */
    public function message( Message $message )
    {
        if( $message instanceof Service\Discovery )
        {
            return new Service\Subscription( $this->findService( $message->getKey() ) );
        }
        
        else if( $message instanceof Service\Subscription )
        {
            $this->addService( $message->getKey(), $message->getService() );
                    
            return $message;
        }
    }
    
    /**
     * Locate a service
     * 
     * @param string $key
     * @return Service 
     */
    public function find( $key )
    {
        if( isset( $this->services[ $key ] ) )
        {
            return $this->services[ $key ];
        }
        
        throw new NotFoundException( 'Could not locate service' );
    }
    
    /**
     * Add a service
     * 
     * @param string $key
     * @param Service $service 
     */
    public function register( $key, Service $service )
    {
        if( !is_string( $key ) || 0 >= strlen( $key ) )
        {
            throw new \InvalidArgumentException( 'Key must be a string' );
        }
        
        $this->services->offsetSet( $key, $service );
        
        return $service;
    }
    
    /**
     * Remove a service
     * 
     * @param string $key
     * @param Service $service 
     */
    public function unregister( $key )
    {
        if( isset( $this->services[ $key ] ) )
        {
            $this->services->offsetUnset( $key );
            
            return $service;
        }
        
        throw new NotFoundException( 'Could not locate service' );
    }
}