<?php

namespace Kava\Message\Client;

use Kava\Message;

interface Recipient
{
    public function receive( Sender $sender, Message $message );
}