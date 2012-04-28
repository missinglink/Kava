<?php

namespace Kava\Message\Client;

use Kava\Message;

interface Recipient
{
    public function message( Sender $sender, Message $message );
}