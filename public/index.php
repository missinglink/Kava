<?php

namespace Kava;

require_once 'autoloader.php';

\error_reporting( \E_ALL | \E_STRICT );
\ini_set( 'error_reporting', 'On' );

$gateway    = new CGIGateway;
$request    = new Request(
                    $gateway->getRequestURL(),
                    $gateway->getRequestHeaders(),
                    $gateway->getRequestBody()
              );

echo '<pre>';
var_dump( $request );