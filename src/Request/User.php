<?php

namespace MaxBeckers\AmazonAlexa\Request;

use MaxBeckers\AmazonAlexa\Helper\PropertyHelper;

/**
 * @author Maximilian Beckers <beckers.maximilian@gmail.com>
 */
class User
{
    /**
     * @var string|null
     */
    public $userId;

    /**
     * @var UserPermissions|null
     */
    public $permissions;

    /**
     * @var string|null
     */
    public $accessToken;

    /**
     * @param array $amazonRequest
     *
     * @return User
     */
    public static function fromAmazonRequest(array $amazonRequest): self
    {
        $user = new self();

        $user->userId      = PropertyHelper::checkNullValue($amazonRequest,'userId');
        $user->permissions = isset($amazonRequest['permissions']) ? UserPermissions::fromAmazonRequest($amazonRequest['permissions']) : null;
        $user->accessToken = PropertyHelper::checkNullValue($amazonRequest,'accessToken');

        return $user;
    }
}
