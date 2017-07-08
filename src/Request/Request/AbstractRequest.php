<?php

namespace MaxBeckers\AmazonAlexa\Request\Request;

/**
 * @author Maximilian Beckers <beckers.maximilian@gmail.com>
 */
abstract class AbstractRequest
{
    /**
     * @var string
     */
    public $type;

    /**
     * @var \DateTime
     */
    public $timestamp;

    /**
     * @param array $amazonRequest
     *
     * @return AbstractRequest
     */
    public static abstract function fromAmazonRequest(array $amazonRequest): AbstractRequest;

    /**
     * @return bool
     */
    public function validateTimestamp(): bool
    {
        return true;
    }

    /**
     * @return bool
     */
    public function validateSignature(): bool
    {
        return true;
    }
}