<?php

namespace MaxBeckers\AmazonAlexa\Request\Request\System;

/**
 * @author Maximilian Beckers <beckers.maximilian@gmail.com>
 */
class Cause
{
    /**
     * @var string|null
     */
    public $requestId;

    /**
     * @param array $amazonRequest
     *
     * @return Cause
     */
    public static function fromAmazonRequest(array $amazonRequest): self
    {
        $cause = new self();

        $cause->requestId = isset($amazonRequest['requestId']) ? $amazonRequest['requestId'] : null;

        return $cause;
    }
}
