<?php

namespace MaxBeckers\AmazonAlexa\Request;

use MaxBeckers\AmazonAlexa\Helper\PropertyHelper;

/**
 * Represents the current Skill.
 *
 * @author Maximilian Beckers <beckers.maximilian@gmail.com>
 */
class Application
{
    /**
     * @var string|null
     */
    public $applicationId;

    /**
     * @param array $amazonRequest
     *
     * @return Application
     */
    public static function fromAmazonRequest(array $amazonRequest): self
    {
        $application = new self();

        $application->applicationId = PropertyHelper::checkNullValue($amazonRequest,'applicationId');

        return $application;
    }
}
