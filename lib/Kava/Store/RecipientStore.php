<?php

namespace Kava\Store;

class RecipientStore extends InstanceStore
{
    public function __construct( $className = 'Kava\Message\Client\Recipient' )
    {
        parent::__construct( $className );
    }
}
