<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Request\Request\Standard;

use MaxBeckers\AmazonAlexa\Helper\PropertyHelper;
use MaxBeckers\AmazonAlexa\Intent\Intent;
use MaxBeckers\AmazonAlexa\Request\Request\AbstractRequest;

class IntentRequest extends StandardRequest
{
    public const DIALOG_STATE_STARTED = 'STARTED';
    public const DIALOG_STATE_IN_PROGRESS = 'IN_PROGRESS';
    public const DIALOG_STATE_COMPLETED = 'COMPLETED';

    public const TYPE = 'IntentRequest';

    /**
     * @param \DateTime|null $timestamp Request timestamp
     * @param string|null $token Request token
     * @param string|null $requestId Request identifier
     * @param string|null $locale Request locale
     * @param string|null $dialogState Current dialog state
     * @param Intent|null $intent Intent information
     */
    public function __construct(
        ?\DateTime $timestamp = null,
        ?string $token = null,
        ?string $requestId = null,
        ?string $locale = null,
        public ?string $dialogState = null,
        public ?Intent $intent = null,
    ) {
        parent::__construct(
            type: static::TYPE,
            timestamp: $timestamp,
            token: $token,
            requestId: $requestId,
            locale: $locale
        );
    }

    public static function fromAmazonRequest(array $amazonRequest): AbstractRequest
    {
        return new static(
            timestamp: self::getTime(PropertyHelper::checkNullValueStringOrInt($amazonRequest, 'timestamp')),
            requestId: PropertyHelper::checkNullValueString($amazonRequest, 'requestId'),
            locale: PropertyHelper::checkNullValueString($amazonRequest, 'locale'),
            dialogState: PropertyHelper::checkNullValueString($amazonRequest, 'dialogState'),
            intent: Intent::fromAmazonRequest($amazonRequest['intent']),
        );
    }
}
