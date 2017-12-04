<?php

namespace MaxBeckers\AmazonAlexa\Intent;

/**
 * @author Maximilian Beckers <beckers.maximilian@gmail.com>
 */
class IntentStatus
{
    /**
     * @var string|null
     */
    public $code;

    /**
     * @param array $amazonRequest
     *
     * @return IntentStatus
     */
    public static function fromAmazonRequest(array $amazonRequest): self
    {
        $intentStatus = new self();

        $intentStatus->code = isset($amazonRequest['code']) ? $amazonRequest['code'] : null;

        return $intentStatus;
    }
}
