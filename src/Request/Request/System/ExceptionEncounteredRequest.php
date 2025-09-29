<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Request\Request\System;

use MaxBeckers\AmazonAlexa\Request\Request\AbstractRequest;
use MaxBeckers\AmazonAlexa\Request\Request\Error;

class ExceptionEncounteredRequest extends SystemRequest
{
    public const TYPE = 'System.ExceptionEncountered';

    public ?Error $error = null;
    public ?Cause $cause = null;

    public static function fromAmazonRequest(array $amazonRequest): AbstractRequest
    {
        $request = new self();

        $request->type = self::TYPE;
        $request->error = isset($amazonRequest['error']) ? Error::fromAmazonRequest($amazonRequest['error']) : null;
        $request->cause = isset($amazonRequest['cause']) ? Cause::fromAmazonRequest($amazonRequest['cause']) : null;
        $request->setRequestData($amazonRequest);

        return $request;
    }
}
