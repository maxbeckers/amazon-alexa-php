<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Request\Request\Standard;

use MaxBeckers\AmazonAlexa\Helper\PropertyHelper;
use MaxBeckers\AmazonAlexa\Request\Request\AbstractRequest;
use MaxBeckers\AmazonAlexa\Request\Request\Error;

class SessionEndedRequest extends StandardRequest
{
    public const TYPE = 'SessionEndedRequest';

    /**
     * @param \DateTime|null $timestamp Request timestamp
     * @param string|null $token Request token
     * @param string|null $requestId Request identifier
     * @param string|null $locale Request locale
     * @param string|null $reason Reason for session ending
     * @param Error|null $error Error information if session ended due to error
     */
    public function __construct(
        ?\DateTime $timestamp = null,
        ?string $token = null,
        ?string $requestId = null,
        ?string $locale = null,
        public ?string $reason = null,
        public ?Error $error = null,
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
            requestId: PropertyHelper::checkNullValueString($amazonRequest, 'requestId'),
            locale: PropertyHelper::checkNullValueString($amazonRequest, 'locale'),
            reason: PropertyHelper::checkNullValueString($amazonRequest, 'reason'),
            error: isset($amazonRequest['error']) ? Error::fromAmazonRequest($amazonRequest['error']) : null,
        );
    }
}
