<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Response\CanFulfill;

use MaxBeckers\AmazonAlexa\Response\ResponseBodyInterface;

class CanFulfillResponseBody implements ResponseBodyInterface
{
    public function __construct(
        public ?CanFulfillIntentResponse $canFulfillIntent = null
    ) {
    }

    public static function create(CanFulfillIntentResponse $canFulfillIntent): self
    {
        return new self($canFulfillIntent);
    }
}
