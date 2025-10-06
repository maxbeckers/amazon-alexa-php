<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Request\Request\Standard;

use MaxBeckers\AmazonAlexa\Request\Request\AbstractRequest;

abstract class StandardRequest extends AbstractRequest
{
    /**
     * @param string $type Request type
     * @param \DateTime|null $timestamp Request timestamp
     * @param string|null $token Request token
     * @param string|null $requestId Request identifier
     * @param string|null $locale Request locale
     */
    public function __construct(
        string $type,
        ?\DateTime $timestamp = null,
        public ?string $token = null,
        public ?string $requestId = null,
        public ?string $locale = null,
    ) {
        parent::__construct(type: $type, timestamp: $timestamp);
    }
}
