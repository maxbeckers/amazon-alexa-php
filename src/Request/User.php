<?php

namespace MaxBeckers\AmazonAlexa\Request;

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
    public static function fromAmazonRequest(array $amazonRequest): User
    {
        $user = new self();

        $user->userId      = isset($amazonRequest['userId']) ? $amazonRequest['userId'] : null;
        $user->permissions = isset($amazonRequest['permissions']) ? UserPermissions::fromAmazonRequest($amazonRequest['permissions']) : null;
        $user->accessToken = isset($amazonRequest['accessToken']) ? $amazonRequest['accessToken'] : null;

        return $user;
    }
}
