<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\CanFulfill;

use MaxBeckers\AmazonAlexa\Response\ResponseBodyInterface;

class CanFulfillResponseBody implements ResponseBodyInterface
{
    public ?CanFulfillIntentResponse $canFulfillIntent = null;

    public static function create(CanFulfillIntentResponse $canFulfillIntent): self
    {
        $canFulfillResponseBody = new self();

        $canFulfillResponseBody->canFulfillIntent = $canFulfillIntent;

        return $canFulfillResponseBody;
    }
}
