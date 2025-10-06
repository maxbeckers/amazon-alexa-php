<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Request\Request\AlexaSkillEvent;

use MaxBeckers\AmazonAlexa\Helper\PropertyHelper;
use MaxBeckers\AmazonAlexa\Request\Request\AbstractRequest;

class SkillDisabledRequest extends AlexaSkillEventRequest
{
    public const TYPE = 'AlexaSkillEvent.SkillDisabled';

    /**
     * @param \DateTime|null $timestamp Request timestamp
     * @param \DateTime|null $eventCreationTime Event creation time
     * @param \DateTime|null $eventPublishingTime Event publishing time
     * @param string|null $requestId Request identifier
     * @param SkillDisabledBody|null $body Skill disabled body data
     */
    public function __construct(
        ?\DateTime $timestamp = null,
        ?\DateTime $eventCreationTime = null,
        ?\DateTime $eventPublishingTime = null,
        ?string $requestId = null,
        public ?SkillDisabledBody $body = null,
    ) {
        parent::__construct(
            type: self::TYPE,
            timestamp: $timestamp,
            eventCreationTime: $eventCreationTime,
            eventPublishingTime: $eventPublishingTime,
            requestId: $requestId
        );
    }

    public static function fromAmazonRequest(array $amazonRequest): AbstractRequest
    {
        return new self(
            timestamp: self::getTime(PropertyHelper::checkNullValueStringOrInt($amazonRequest, 'timestamp')),
            eventCreationTime: self::getTime(PropertyHelper::checkNullValueStringOrInt($amazonRequest, 'eventCreationTime')),
            eventPublishingTime: self::getTime(PropertyHelper::checkNullValueStringOrInt($amazonRequest, 'eventPublishingTime')),
            requestId: PropertyHelper::checkNullValueString($amazonRequest, 'requestId'),
            body: isset($amazonRequest['body']) ? SkillDisabledBody::fromAmazonRequest($amazonRequest['body']) : null,
        );
    }
}
