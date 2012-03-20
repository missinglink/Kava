<?php

require_once 'autoloader.php';

error_reporting( \E_ALL );
ini_set( 'display_errors', 'On' );
ini_set( 'html_errors', 'Off' );

$request = new \Kava\HTTP\Request;

$gateway = new \Kava\HTTP\Gateway\WebServer;
$gateway->update( $request );

echo '<pre>';
var_dump( $request, $request->getHeaders(), $request->getQueryData(), $request->getBody() );