<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Request;

use MaxBeckers\AmazonAlexa\Helper\PropertyHelper;

/**
 * Represents the current Skill.
 */
class Application
{
    public ?string $applicationId = null;

    public static function fromAmazonRequest(array $amazonRequest): self
    {
        $application = new self();

        $application->applicationId = PropertyHelper::checkNullValueString($amazonRequest, 'applicationId');

        return $application;
    }
}
