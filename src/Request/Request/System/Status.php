<?php

namespace MaxBeckers\AmazonAlexa\Request\Request\System;

/**
 * @author Maximilian Beckers <beckers.maximilian@gmail.com>
 */
class Status
{
    /**
     * @var string|null
     */
    public $code;

    /**
     * @var string|null
     */
    public $message;

    /**
     * @param array $amazonRequest
     *
     * @return Status
     */
    public static function fromAmazonRequest(array $amazonRequest): self
    {
        $status = new self();

        $status->code    = isset($amazonRequest['code']) ? $amazonRequest['code'] : null;
        $status->message = isset($amazonRequest['message']) ? $amazonRequest['message'] : null;

        return $status;
    }
}
