<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Request\Request\CanFulfill;

use MaxBeckers\AmazonAlexa\Request\Request\Standard\IntentRequest;

class CanFulfillIntentRequest extends IntentRequest
{
    public const TYPE = 'CanFulfillIntentRequest';
}
