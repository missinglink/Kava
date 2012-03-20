<?php

namespace Kava;

class Hiccup
{
    public static function register( $errorLevel = \E_ALL )
    {
        set_exception_handler( __CLASS__ . '::onException' );
        set_error_handler( __CLASS__ . '::onError', $errorLevel );
    }
    
    public static function onException( \Exception $e )
    {
         self::terminate( self::buildDebugMessage( $e ) );
    }
    
    public static function onError( $errno, $errstr, $errfile, $errline )
    {
        if( isset( $errno, $errstr, $errfile, $errline ) )
        {
            // Do not halt script execution for errors not in the error_reporting bitmask.
            if( error_reporting() & $errno )
            {
                return self::onException( new \ErrorException( $errstr, $errno, \E_ERROR, $errfile, $errline ) );
            }
        }
        
        else self::terminate();
        
        /* Don't execute PHP internal error handler */
        return true;
    }
    
    private static function buildDebugMessage( \Exception $e, $prefix = '' )
    {
        $message  = $prefix . $e->getMessage() . \PHP_EOL;
        $message .= $prefix . $e->getFile() . ':' . $e->getLine() . \PHP_EOL;
        $message .= $prefix . $e->getTraceAsString() . \PHP_EOL;

        if( ( $p = $e->getPrevious() ) instanceof \Exception )
        {
            $message .= \PHP_EOL;
            $message .= self::buildDebugMessage( $p, $prefix . "\t" );
        }
        
        return $message;
    }
    
    /*
     * Something really bad just happened
     * 
     *  ▄██████████████▄▐█▄▄▄▄█▌
     *  ██████▌▄▌▄▐▐▌███▌▀▀██▀▀ 
     *  ████▄█▌▄▌▄▐▐▌▀███▄▄█▌
     *  ▄▄▄▄▄██████████████▀
     * 
     */
    private static function terminate( $message = null )
    {
        header( 'Content-type: text/plain' );
        echo 'Service is currently unavailable, Please try again later.' . \PHP_EOL;
        
        if( is_string( $message ) )
        {
            echo $message;
        }
        
        exit;
    }
}