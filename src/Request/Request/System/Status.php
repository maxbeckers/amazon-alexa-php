<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Request\Request\System;

use MaxBeckers\AmazonAlexa\Helper\PropertyHelper;

class Status
{
    public ?string $code = null;
    public ?string $message = null;

    public static function fromAmazonRequest(array $amazonRequest): self
    {
        $status = new self();

        $status->code = PropertyHelper::checkNullValueString($amazonRequest, 'code');
        $status->message = PropertyHelper::checkNullValueString($amazonRequest, 'message');

        return $status;
    }
}
