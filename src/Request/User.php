<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Request;

use MaxBeckers\AmazonAlexa\Helper\PropertyHelper;

class User
{
    public ?string $userId = null;
    public ?UserPermissions $permissions = null;
    public ?string $accessToken = null;

    public static function fromAmazonRequest(array $amazonRequest): self
    {
        $user = new self();

        $user->userId = PropertyHelper::checkNullValueString($amazonRequest, 'userId');
        $user->permissions = isset($amazonRequest['permissions']) ? UserPermissions::fromAmazonRequest($amazonRequest['permissions']) : null;
        $user->accessToken = PropertyHelper::checkNullValueString($amazonRequest, 'accessToken');

        return $user;
    }
}
