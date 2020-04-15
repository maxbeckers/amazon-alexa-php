<?php

namespace MaxBeckers\AmazonAlexa\Request\Request\AlexaSkillEvent;

/**
 * @author Maximilian Beckers <beckers.maximilian@gmail.com>
 */
class SkillDisabledBody
{
    const PERSISTED     = 'PERSISTED';
    const NOT_PERSISTED = 'NOT_PERSISTED';

    /**
     * @var string|null
     */
    public $userInformationPersistenceStatus;

    /**
     * @param array $amazonRequest
     *
     * @return SkillDisabledBody
     */
    public static function fromAmazonRequest(array $amazonRequest): self
    {
        $body = new self();

        $body->userInformationPersistenceStatus = isset($amazonRequest['userInformationPersistenceStatus']) ? $amazonRequest['userInformationPersistenceStatus'] : null;

        return $body;
    }
}
