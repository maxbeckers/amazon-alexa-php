<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Request\Request\AlexaSkillEvent;

use MaxBeckers\AmazonAlexa\Helper\PropertyHelper;

class Permission
{
    public ?string $scope = null;

    public static function fromAmazonRequest(array $amazonRequest): self
    {
        $permission = new self();

        $permission->scope = PropertyHelper::checkNullValueString($amazonRequest, 'scope');

        return $permission;
    }
}
