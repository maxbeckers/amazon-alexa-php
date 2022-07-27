<?php

namespace MaxBeckers\AmazonAlexa\Request\Request\System;

use MaxBeckers\AmazonAlexa\Helper\PropertyHelper;

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

        $cause->requestId = PropertyHelper::checkNullValue($amazonRequest,'requestId');

        return $cause;
    }
}
