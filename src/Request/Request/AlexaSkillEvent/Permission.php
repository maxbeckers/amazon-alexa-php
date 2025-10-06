<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Request\Request\AlexaSkillEvent;

use MaxBeckers\AmazonAlexa\Helper\PropertyHelper;

class Permission
{
    /**
     * @param string|null $scope Permission scope
     */
    public function __construct(
        public ?string $scope = null,
    ) {
    }

    public static function fromAmazonRequest(array $amazonRequest): self
    {
        return new self(
            scope: PropertyHelper::checkNullValueString($amazonRequest, 'scope'),
        );
    }
}
