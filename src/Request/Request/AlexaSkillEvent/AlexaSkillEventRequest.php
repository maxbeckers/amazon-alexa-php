<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Request\Request\AlexaSkillEvent;

use MaxBeckers\AmazonAlexa\Request\Request\AbstractRequest;

abstract class AlexaSkillEventRequest extends AbstractRequest
{
    /**
     * @param string $type Request type
     * @param \DateTime|null $timestamp Request timestamp
     * @param \DateTime|null $eventCreationTime Event creation time
     * @param \DateTime|null $eventPublishingTime Event publishing time
     * @param string|null $requestId Request identifier
     */
    public function __construct(
        string $type,
        ?\DateTime $timestamp = null,
        public ?\DateTime $eventCreationTime = null,
        public ?\DateTime $eventPublishingTime = null,
        public ?string $requestId = null,
    ) {
        parent::__construct(type: $type, timestamp: $timestamp);
    }
}
