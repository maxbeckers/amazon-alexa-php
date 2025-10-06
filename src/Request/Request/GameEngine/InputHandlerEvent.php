<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Request\Request\GameEngine;

use MaxBeckers\AmazonAlexa\Helper\PropertyHelper;
use MaxBeckers\AmazonAlexa\Request\Request\AbstractRequest;
use MaxBeckers\AmazonAlexa\Request\Request\GameEngine\Event\Event;
use MaxBeckers\AmazonAlexa\Request\Request\Standard\StandardRequest;

class InputHandlerEvent extends StandardRequest
{
    public const TYPE = 'GameEngine.InputHandlerEvent';

    /**
     * @param \DateTime|null $timestamp Request timestamp
     * @param string|null $token Request token
     * @param string|null $requestId Request identifier
     * @param string|null $locale Request locale
     * @param string|null $originatingRequestId ID of the originating request
     * @param Event[] $events Array of game engine events
     */
    public function __construct(
        ?\DateTime $timestamp = null,
        ?string $token = null,
        ?string $requestId = null,
        ?string $locale = null,
        public ?string $originatingRequestId = null,
        public array $events = [],
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
        $events = [];
        foreach ($amazonRequest['events'] as $event) {
            $events[] = Event::fromAmazonRequest($event);
        }

        return new self(
            timestamp: self::getTime(PropertyHelper::checkNullValueStringOrInt($amazonRequest, 'timestamp')),
            requestId: PropertyHelper::checkNullValueString($amazonRequest, 'requestId'),
            locale: PropertyHelper::checkNullValueString($amazonRequest, 'locale'),
            originatingRequestId: PropertyHelper::checkNullValueString($amazonRequest, 'originatingRequestId'),
            events: $events,
        );
    }
}
