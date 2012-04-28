<?php

namespace Kava;

use Kava\Message;
use Kava\Message\Transmission;
use Kava\Message\Client;
use Kava\Store;

require_once 'autoloader.php';

error_reporting( \E_ALL );
ini_set( 'display_errors', 'On' );
ini_set( 'html_errors', 'Off' );

echo '<pre>';

//$host1 = new App;

$locator = new Service\Locator;

$client = new Service\Http\Client;
$locator->register( 'http.client', $client );

// Register service using a Subscription message
//$clientSubscription = new Service\Subscription( 'http.client', $client );
//var_dump( $serviceLocator->message( $clientSubscription ) );

$service = $locator->find( 'http.client' );
$httpResponse = $service->request( 'http://www.google.com' );

var_dump( $httpResponse );

// Single Message
//$response = $host1->send( $request );

//var_dump( $response );

// Store a list of Recipients
//$recipients = new Store\RecipientStore;
//$recipients->attach( $host1 );
//$recipients->attach( $host2 );
//$recipients->attach( $host3 );
//
//// Create a Message Broadcaster
//$broadcast = new Transmission\Broadcaster( $recipients );
//
//$senderWhitelist = new Message\Proxy\SenderWhitelist( $broadcast );
//$senderWhitelist->attach( $host2 );
//$senderWhitelist->attach( $host3 );
//
//$senderBlacklist = new Message\Proxy\SenderBlacklist( $senderWhitelist );
//$senderBlacklist->attach( $host1 );
//
//$messageClassProxy = new Message\Proxy\MessageClassWhitelist( $senderBlacklist );
//$messageClassProxy->enqueue( 'Kava\StringMessage' );
//
////
//
//$host1->send( $messageClassProxy, new StringMessage( 'Hi There from Host 1' ) );
//$host2->send( $messageClassProxy, new StringMessage( 'Hi There from Host 2' ) );
//$host3->send( $messageClassProxy, new StringMessage( 'Hi There from Host 3' ) );
