<?php

namespace Kava\HTTP;

require_once 'PHPUnit/Framework.php';
require_once dirname( __FILE__ ) . '/../../../../lib/Kava/HTTP/URL.php';

class URLTest extends \PHPUnit_Framework_TestCase
{
    public function testParseFullyQualifiedURL()
    {
        $url = \Kava\HTTP\URL::factory( 'http://username:password@hostname:8080/path?arg=value#anchor' );
        
        $this->assertEquals( 'http',      $url->scheme );
        $this->assertEquals( 'hostname',  $url->host );
        $this->assertEquals( '8080',      $url->port );
        $this->assertEquals( 'username',  $url->user );
        $this->assertEquals( 'password',  $url->pass );
        $this->assertEquals( '/path',     $url->path );
        $this->assertEquals( 'arg=value', $url->query );
        $this->assertEquals( 'anchor',    $url->fragment );
    }
    
    public function testParseSecurePortURL()
    {
        $url = \Kava\HTTP\URL::factory( 'https://localhost:443/secure?arg=value#anchor' );
        
        $this->assertEquals( 'https',     $url->scheme );
        $this->assertEquals( 'localhost', $url->host );
        $this->assertEquals( '443',       $url->port );
        $this->assertEquals( '',          $url->user );
        $this->assertEquals( '',          $url->pass );
        $this->assertEquals( '/secure',   $url->path );
        $this->assertEquals( 'arg=value', $url->query );
        $this->assertEquals( 'anchor',    $url->fragment );
    }
    
    public function testParseRelativeURL()
    {
        $url = \Kava\HTTP\URL::factory( '/path?arg=value#anchor' );

        $this->assertEquals( '',          $url->scheme );
        $this->assertEquals( '',          $url->host );
        $this->assertEquals( '',          $url->port );
        $this->assertEquals( '',          $url->user );
        $this->assertEquals( '',          $url->pass );
        $this->assertEquals( '/path',     $url->path );
        $this->assertEquals( 'arg=value', $url->query );
        $this->assertEquals( 'anchor',    $url->fragment );
    }
    
    public function testGetHostNameFromHeaders()
    {
        $headers = new \ArrayObject( array( 'Host' => 'localhost' ) );
        
        $url = \Kava\HTTP\URL::factory( '/path?arg=value#anchor', $headers );

        $this->assertEquals( '',          $url->scheme );
        $this->assertEquals( 'localhost', $url->host );
        $this->assertEquals( '',          $url->port );
        $this->assertEquals( '',          $url->user );
        $this->assertEquals( '',          $url->pass );
        $this->assertEquals( '/path',     $url->path );
        $this->assertEquals( 'arg=value', $url->query );
        $this->assertEquals( 'anchor',    $url->fragment );
    }
    
    /**
     * Data provider for ImplodeAndExplode tests
     * 
     * @return array 
     */
    public static function implodeAndExplodeDataProvider()
    {
        return array(
            array( 'http://username:password@hostname:8080/path?arg=value#anchor' ),
            array( 'https://localhost:22/secure?arg=value#anchor' ),
            array( 'ftp://localhost:10/folder/file.txt' ),
        );
    }
    
    /**
     * Test that URLs are equal when parsed and reconstituted
     * 
     * @dataProvider implodeAndExplodeDataProvider
     */
    public function testImplodeAndExplode( $urlString )
    {
        $url = \Kava\HTTP\URL::factory( $urlString );
        
        $this->assertEquals( $urlString, (string) $url );
    }
    
    /**
     * Test that default ports are removed
     */
    public function testDefaultPortsAreRemoved()
    {
        $this->assertEquals( 'http://localhost/',  (string) \Kava\HTTP\URL::factory( 'http://localhost:80/' ) );
        $this->assertEquals( 'https://localhost/', (string) \Kava\HTTP\URL::factory( 'https://localhost:443/' ) );
        $this->assertEquals( 'ftp://localhost/',   (string) \Kava\HTTP\URL::factory( 'ftp://localhost:21/' ) );
        $this->assertEquals( 'ssh://localhost/',   (string) \Kava\HTTP\URL::factory( 'ssh://localhost:22/' ) );
    }
    
    /**
     * Test that paths are correctly resolved
     */
    public function testPathsAreResolved()
    {
        $this->assertEquals( 'http://localhost/',  (string) \Kava\HTTP\URL::factory( 'http://localhost' ) );
        $this->assertEquals( 'http://localhost/b', (string) \Kava\HTTP\URL::factory( 'http://localhost/a/../b' ) );
        $this->assertEquals( 'http://localhost/',  (string) \Kava\HTTP\URL::factory( 'http://localhost/../.' ) );
    }
}