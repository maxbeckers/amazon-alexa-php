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

    public ?string $purchaseResult = null;
    public ?string $productId = null;
    public ?string $message = null;

    public static function fromAmazonRequest(array $amazonRequest): self
    {
        $status = new self();

        $status->purchaseResult = PropertyHelper::checkNullValueString($amazonRequest, 'purchaseResult');
        $status->productId = PropertyHelper::checkNullValueString($amazonRequest, 'productId');
        $status->message = PropertyHelper::checkNullValueString($amazonRequest, 'message');

        return $status;
    }
}
