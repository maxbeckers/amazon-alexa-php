<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Request\Request\AlexaSkillEvent;

use MaxBeckers\AmazonAlexa\Request\Request\AbstractRequest;

abstract class AlexaSkillEventRequest extends AbstractRequest
{
    public ?\DateTime $eventCreationTime = null;
    public ?\DateTime $eventPublishingTime = null;
    public ?string $requestId = null;

    protected function setRequestData(array $amazonRequest): void
    {
        $this->requestId = $amazonRequest['requestId'];

        $this->setTime('eventCreationTime', $amazonRequest['eventCreationTime']);
        $this->setTime('eventPublishingTime', $amazonRequest['eventPublishingTime']);
    }
}
