<?php

namespace MaxBeckers\AmazonAlexa\Request\Request\AlexaSkillEvent;

use MaxBeckers\AmazonAlexa\Helper\PropertyHelper;

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

        $body->userInformationPersistenceStatus = PropertyHelper::checkNullValue($amazonRequest, 'userInformationPersistenceStatus');

        return $body;
    }
}
