<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Request\Request\System;

use MaxBeckers\AmazonAlexa\Helper\PropertyHelper;

class Payload
{
    public const RESULT_ACCEPTED = 'ACCEPTED';
    public const RESULT_DECLINED = 'DECLINED';
    public const RESULT_ALREADY_PURCHASED = 'ALREADY_PURCHASED';
    public const RESULT_ERROR = 'ERROR';

    /**
     * @param string|null $purchaseResult Purchase result status
     * @param string|null $productId Product identifier
     * @param string|null $message Additional message
     */
    public function __construct(
        public ?string $purchaseResult = null,
        public ?string $productId = null,
        public ?string $message = null,
    ) {
    }

    public static function fromAmazonRequest(array $amazonRequest): self
    {
        return new self(
            purchaseResult: PropertyHelper::checkNullValueString($amazonRequest, 'purchaseResult'),
            productId: PropertyHelper::checkNullValueString($amazonRequest, 'productId'),
            message: PropertyHelper::checkNullValueString($amazonRequest, 'message'),
        );
    }
}
