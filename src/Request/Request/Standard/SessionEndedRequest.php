<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Request\Request\Standard;

use MaxBeckers\AmazonAlexa\Helper\PropertyHelper;
use MaxBeckers\AmazonAlexa\Request\Request\AbstractRequest;
use MaxBeckers\AmazonAlexa\Request\Request\Error;

class SessionEndedRequest extends StandardRequest
{
    public const TYPE = 'SessionEndedRequest';

    public ?string $reason = null;
    public ?Error $error = null;

    public static function fromAmazonRequest(array $amazonRequest): AbstractRequest
    {
        $request = new self();

        $request->type = self::TYPE;
        $request->reason = PropertyHelper::checkNullValueString($amazonRequest, 'reason');
        $request->error = isset($amazonRequest['error']) ? Error::fromAmazonRequest($amazonRequest['error']) : null;
        $request->setRequestData($amazonRequest);

        return $request;
    }
}
