<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Request;

use MaxBeckers\AmazonAlexa\Helper\PropertyHelper;

class UserPermissions
{
    public ?string $consentToken = null;

    public static function fromAmazonRequest(array $amazonRequest): self
    {
        $userPermissions = new self();

        $userPermissions->consentToken = PropertyHelper::checkNullValueString($amazonRequest, 'consentToken');

        return $userPermissions;
    }
}
