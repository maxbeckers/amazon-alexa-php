<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Request\Request\Display;

use MaxBeckers\AmazonAlexa\Helper\PropertyHelper;
use MaxBeckers\AmazonAlexa\Request\Request\AbstractRequest;
use MaxBeckers\AmazonAlexa\Request\Request\Standard\StandardRequest;

class ElementSelectedRequest extends StandardRequest
{
    public const TYPE = 'Display.ElementSelected';

    /**
     * @param \DateTime|null $timestamp Request timestamp
     * @param string|null $token Element token that was selected
     * @param string|null $requestId Request identifier
     * @param string|null $locale Request locale
     */
    public function __construct(
        ?\DateTime $timestamp = null,
        ?string $token = null,
        ?string $requestId = null,
        ?string $locale = null,
    ) {
        parent::__construct(
            type: self::TYPE,
            timestamp: $timestamp,
            token: $token,
            requestId: $requestId,
            locale: $locale
        );
    }

    public static function fromAmazonRequest(array $amazonRequest): AbstractRequest
    {
        return new self(
            timestamp: self::getTime(PropertyHelper::checkNullValueStringOrInt($amazonRequest, 'timestamp')),
            token: PropertyHelper::checkNullValueString($amazonRequest, 'token'),
            requestId: PropertyHelper::checkNullValueString($amazonRequest, 'requestId'),
            locale: PropertyHelper::checkNullValueString($amazonRequest, 'locale'),
        );
    }
}
