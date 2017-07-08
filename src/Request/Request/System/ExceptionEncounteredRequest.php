<?php

namespace MaxBeckers\AmazonAlexa\Request\Request\System;

use MaxBeckers\AmazonAlexa\Request\Request\AbstractRequest;
use MaxBeckers\AmazonAlexa\Request\Request\Error;

/**
 * @author Maximilian Beckers <beckers.maximilian@gmail.com>
 */
class ExceptionEncounteredRequest extends SystemRequest
{
    const TYPE = 'System.ExceptionEncountered';

    /**
     * @var Error|null
     */
    public $error;

    /**
     * @var Cause|null
     */
    public $cause;

    /**
     * {@inheritdoc}
     */
    public static function fromAmazonRequest(array $amazonRequest): AbstractRequest
    {
        $request = new self();

        $request->type  = self::TYPE;
        $request->error = isset($amazonRequest['error']) ? Error::fromAmazonRequest($amazonRequest['error']) : null;
        $request->cause = isset($amazonRequest['cause']) ? Cause::fromAmazonRequest($amazonRequest['cause']) : null;
        $request->setRequestData($amazonRequest);

        return $request;
    }
}
