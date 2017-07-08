<?php

namespace MaxBeckers\AmazonAlexa\Request;

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
    public static function fromAmazonRequest(array $amazonRequest): Application
    {
        $application = new self();

        $application->applicationId = isset($amazonRequest['applicationId']) ? $amazonRequest['applicationId'] : null;

        return $application;
    }
}
