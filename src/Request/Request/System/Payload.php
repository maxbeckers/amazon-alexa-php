<?php

namespace MaxBeckers\AmazonAlexa\Request\Request\System;

use MaxBeckers\AmazonAlexa\Helper\PropertyHelper;

/**
 * @author Maximilian Beckers <beckers.maximilian@gmail.com>
 */
class Payload
{
    const RESULT_ACCEPTED          = 'ACCEPTED';
    const RESULT_DECLINED          = 'DECLINED';
    const RESULT_ALREADY_PURCHASED = 'ALREADY_PURCHASED';
    const RESULT_ERROR             = 'ERROR';

    /**
     * @var string|null
     */
    public $purchaseResult;

    /**
     * @var string|null
     */
    public $productId;

    /**
     * @var string|null
     */
    public $message;

    /**
     * @param array $amazonRequest
     *
     * @return Payload
     */
    public static function fromAmazonRequest(array $amazonRequest): self
    {
        $status = new self();

        $status->purchaseResult = PropertyHelper::checkNullValue($amazonRequest,'purchaseResult');
        $status->productId      = PropertyHelper::checkNullValue($amazonRequest,'productId');
        $status->message        = PropertyHelper::checkNullValue($amazonRequest,'message');

        return $status;
    }
}
