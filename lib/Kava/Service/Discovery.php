<?php

namespace Kava\Service;

use Kava\Message;
use Kava\Service;

interface Discovery extends Message
{
    public function discover( Service $service );
}