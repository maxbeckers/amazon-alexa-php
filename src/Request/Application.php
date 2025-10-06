<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Request;

use MaxBeckers\AmazonAlexa\Helper\PropertyHelper;

/**
 * Represents the current Skill.
 */
class Application
{
    /**
     * @param string|null $applicationId The application identifier
     */
    public function __construct(
        public ?string $applicationId = null,
    ) {
    }

    public static function fromAmazonRequest(array $amazonRequest): self
    {
        return new self(
            applicationId: PropertyHelper::checkNullValueString($amazonRequest, 'applicationId'),
        );
    }
}
