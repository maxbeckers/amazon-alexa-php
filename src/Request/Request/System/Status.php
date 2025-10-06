<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Request\Request\System;

use MaxBeckers\AmazonAlexa\Helper\PropertyHelper;

class Status
{
    /**
     * @param string|null $code Status code
     * @param string|null $message Status message
     */
    public function __construct(
        public ?string $code = null,
        public ?string $message = null,
    ) {
    }

    public static function fromAmazonRequest(array $amazonRequest): self
    {
        return new self(
            code: PropertyHelper::checkNullValueString($amazonRequest, 'code'),
            message: PropertyHelper::checkNullValueString($amazonRequest, 'message'),
        );
    }
}
