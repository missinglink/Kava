<?php

namespace Kava\HTTP;

class RequestTest extends \PHPUnit_Framework_TestCase
{
    public static function urlProvider()
    {
        return array(
            array( 'http://username:password@hostname/path?arg=value#anchor' ),
            array( 'ftp://localhost:10/folder/file.txt' ),
            array( 'https://localhost/secure?arg=value#anchor' ),
            array( 'http://api.google.com/' ),
        );
    }
    
    /**
     * @dataProvider urlProvider
     */
    public function testConstructorIsBackwardsCompatible( $url )
    {
        $httpRequest = new \HttpRequest( $url );
        $factory = \Kava\HTTP\URL::factory( $url );
        
        $this->assertEquals( (string) $httpRequest->getUrl(), (string) $factory );
    }
    
    /**
     * @dataProvider urlProvider
     */
    public function testConstructorAndUrlSetterAreCompatible( $url )
    {
        $httpRequest = new \Kava\HTTP\Request( $url );
        $this->assertEquals( (string) $httpRequest->getUrl(), $url );
        
        $httpRequest = new \Kava\HTTP\Request;
        $httpRequest->setUrl( \Kava\HTTP\URL::factory( $url ) );
        $this->assertEquals( (string) $httpRequest->getUrl(), $url );
    }
    
    /**
     * @dataProvider urlProvider
     */
    public function testGetAndSetUrlAreBackwardsCompatible( $url )
    {
        $httpRequest = new \HttpRequest;
        $httpRequest->setUrl( $url );
        $this->assertEquals( (string) $httpRequest->getUrl(), $url );
        
        $httpRequest = new \Kava\HTTP\Request;
        $httpRequest->setUrl( $url );
        $this->assertEquals( (string) $httpRequest->getUrl(), $url );
    }
    
    public static function queryProvider()
    {
        return array(
            array( 'foo=bar&moo=cow', array( 'foo'=>'bar', 'moo'=>'cow' ) ),
        );
    }
    
    /**
     * @dataProvider queryProvider
     */
    public function testGetAndSetQueryDataWithUrlObject( $string, $array )
    {
        $httpRequest = new \Kava\HTTP\Request;
        $httpRequest->setQueryData( new \HttpQueryString( false, $array ) );
        $this->assertEquals( (string) $httpRequest->getQueryData(), $string );
    }
    
    /**
     * @dataProvider queryProvider
     */
    public function testGetAndSetQueryDataAreBackwardsCompatible_Strings( $string, $array )
    {
        $httpRequest = new \HttpRequest;
        $httpRequest->setQueryData( $string );
        $this->assertEquals( (string) $httpRequest->getQueryData(), $string );
        
        $httpRequest = new \Kava\HTTP\Request;
        $httpRequest->setQueryData( $string );
        $this->assertEquals( (string) $httpRequest->getQueryData(), $string );
    }
    
    /**
     * @dataProvider queryProvider
     */
    public function testGetAndSetQueryDataAreBackwardsCompatible_Arrays( $string, $array )
    {
        $httpRequest = new \HttpRequest;
        $httpRequest->setQueryData( $array );
        $this->assertEquals( (string) $httpRequest->getQueryData(), $string );
        
        $httpRequest = new \Kava\HTTP\Request;
        $httpRequest->setQueryData( $array );
        $this->assertEquals( (string) $httpRequest->getQueryData(), $string );
    }
    
    public static function headerProvider()
    {
        return array(
            array( array( 'Host' => 'localhost', 'Accept' => 'test/test' ) ),
        );
    }
    
    /**
     * @dataProvider headerProvider
     */
    public function testGetAndSetHeadersAreBackwardsCompatible( $headers )
    {
        $httpRequest = new \HttpRequest;
        $httpRequest->setHeaders( $headers );
        $this->assertEquals( (array) $httpRequest->getHeaders(), $headers );
        
        $httpRequest = new \Kava\HTTP\Request;
        $httpRequest->setHeaders( $headers );
        $this->assertEquals( (array) $httpRequest->getHeaders(), $headers );
    }
    
    /**
     * @dataProvider headerProvider
     */
    public function testGetAndSetHeadersWithArrayObject( $headers )
    {
        $httpRequest = new \Kava\HTTP\Request;
        $httpRequest->setHeaders( new \ArrayObject( $headers ) );
        $this->assertEquals( (array) $httpRequest->getHeaders(), $headers );
    }
    
    public static function methodNameProvider()
    {
        return array(
            array( \HTTP_METH_GET,     'GET' ),
            array( \HTTP_METH_POST,    'POST' ),
            array( \HTTP_METH_PUT,     'PUT' ),
            array( \HTTP_METH_DELETE,  'DELETE' ),
            array( \HTTP_METH_OPTIONS, 'OPTIONS' ),
            array( \HTTP_METH_GET,     'INVALID' )
        );
    }
    
    /**
     * @dataProvider methodNameProvider
     */
    public function testSetMethodFromName( $expected, $actual )
    {
        $request = new \Kava\HTTP\Request;
        $request->setMethodFromName( $actual );
        
        $this->assertEquals( $expected, $request->getMethod() );
    }   
}