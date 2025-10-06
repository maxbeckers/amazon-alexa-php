<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Request\Request\System;

use MaxBeckers\AmazonAlexa\Helper\PropertyHelper;
use MaxBeckers\AmazonAlexa\Request\Request\AbstractRequest;

class ConnectionsResponseRequest extends SystemRequest
{
    public const TYPE = 'Connections.Response';
    public const NAME_UPSELL = 'Upsell';
    public const NAME_BUY = 'Buy';
    public const NAME_CANCEL = 'CANCEL';

    /**
     * @param \DateTime|null $timestamp Request timestamp
     * @param string|null $requestId Request identifier
     * @param string|null $locale Request locale
     * @param string|null $name Connection response name
     * @param string|null $token Connection response token
     * @param Status|null $status Connection response status
     * @param Payload|null $payload Connection response payload
     */
    public function __construct(
        ?\DateTime $timestamp = null,
        ?string $requestId = null,
        ?string $locale = null,
        public ?string $name = null,
        public ?string $token = null,
        public ?Status $status = null,
        public ?Payload $payload = null,
    ) {
        parent::__construct(self::TYPE, $timestamp, $this->token, $requestId, $locale);
    }

    public static function fromAmazonRequest(array $amazonRequest): AbstractRequest
    {
        return new self(
            timestamp: self::getTime(PropertyHelper::checkNullValueStringOrInt($amazonRequest, 'timestamp')),
            requestId: PropertyHelper::checkNullValueString($amazonRequest, 'requestId'),
            locale: PropertyHelper::checkNullValueString($amazonRequest, 'locale'),
            name: PropertyHelper::checkNullValueString($amazonRequest, 'name'),
            token: PropertyHelper::checkNullValueString($amazonRequest, 'token'),
            status: isset($amazonRequest['status']) ? Status::fromAmazonRequest($amazonRequest['status']) : null,
            payload: isset($amazonRequest['payload']) ? Payload::fromAmazonRequest($amazonRequest['payload']) : null,
        );
    }
}
