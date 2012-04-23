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

$host1 = new Host( 'Host 1' );
$host2 = new Host( 'Host 2' );
$host3 = new Host( 'Host 3' );
$host4 = new Host( 'Host 4' );
$host5 = new Host( 'Host 5' );

// Single Message
$host1->send( $host2, new StringMessage( 'Hi There' ) );

// Store a list of Recipients
$recipients = new Store\RecipientStore;
$recipients->attach( $host1 );
$recipients->attach( $host2 );
$recipients->attach( $host3 );

// Create a Message Broadcaster
$broadcast = new Transmission\Broadcaster( $recipients );

$senderWhitelist = new Message\Proxy\SenderWhitelist( $broadcast );
$senderWhitelist->attach( $host2 );
$senderWhitelist->attach( $host3 );

$senderBlacklist = new Message\Proxy\SenderBlacklist( $senderWhitelist );
$senderBlacklist->attach( $host1 );

$messageClassProxy = new Message\Proxy\MessageClassWhitelist( $senderBlacklist );
$messageClassProxy->enqueue( 'Kava\StringMessage' );

//

$host1->send( $messageClassProxy, new StringMessage( 'Hi There from Host 1' ) );
$host2->send( $messageClassProxy, new StringMessage( 'Hi There from Host 2' ) );
$host3->send( $messageClassProxy, new StringMessage( 'Hi There from Host 3' ) );
