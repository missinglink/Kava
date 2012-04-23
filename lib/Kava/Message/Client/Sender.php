<?php

namespace Kava\Message\Client;

use Kava\Message;

interface Sender
{
    public function send( Recipient $recipient, Message $message );
}