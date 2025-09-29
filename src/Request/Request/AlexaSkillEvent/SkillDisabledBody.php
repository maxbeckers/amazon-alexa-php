<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Request\Request\AlexaSkillEvent;

use MaxBeckers\AmazonAlexa\Helper\PropertyHelper;

class SkillDisabledBody
{
    public const PERSISTED = 'PERSISTED';
    public const NOT_PERSISTED = 'NOT_PERSISTED';

    public ?string $userInformationPersistenceStatus = null;

    public static function fromAmazonRequest(array $amazonRequest): self
    {
        $body = new self();

        $body->userInformationPersistenceStatus = PropertyHelper::checkNullValueString($amazonRequest, 'userInformationPersistenceStatus');

        return $body;
    }
}
