<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Request\Request\System;

use MaxBeckers\AmazonAlexa\Helper\PropertyHelper;

class Cause
{
    /**
     * @param string|null $requestId Request identifier that caused the event
     */
    public function __construct(
        public ?string $requestId = null,
    ) {
    }

    public static function fromAmazonRequest(array $amazonRequest): self
    {
        return new self(
            requestId: PropertyHelper::checkNullValueString($amazonRequest, 'requestId'),
        );
    }
}
