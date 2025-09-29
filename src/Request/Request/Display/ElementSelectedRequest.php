<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Request\Request\Display;

use MaxBeckers\AmazonAlexa\Request\Request\AbstractRequest;
use MaxBeckers\AmazonAlexa\Request\Request\Standard\StandardRequest;

class ElementSelectedRequest extends StandardRequest
{
    public const TYPE = 'Display.ElementSelected';

    public static function fromAmazonRequest(array $amazonRequest): AbstractRequest
    {
        $request = new self();

        $request->type = self::TYPE;
        $request->token = $amazonRequest['token'];
        $request->setRequestData($amazonRequest);

        return $request;
    }
}
