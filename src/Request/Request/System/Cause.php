<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Request\Request\System;

use MaxBeckers\AmazonAlexa\Helper\PropertyHelper;

class Cause
{
    public ?string $requestId = null;

    public static function fromAmazonRequest(array $amazonRequest): self
    {
        $cause = new self();

        $cause->requestId = PropertyHelper::checkNullValueString($amazonRequest, 'requestId');

        return $cause;
    }
}
