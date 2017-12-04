<?php

namespace MaxBeckers\AmazonAlexa\Request;

/**
 * @author Maximilian Beckers <beckers.maximilian@gmail.com>
 */
class UserPermissions
{
    /**
     * @var string|null
     */
    public $consentToken;

    /**
     * @param array $amazonRequest
     *
     * @return UserPermissions
     */
    public static function fromAmazonRequest(array $amazonRequest): self
    {
        $userPermissions = new self();

        $userPermissions->consentToken = isset($amazonRequest['consentToken']) ? $amazonRequest['consentToken'] : null;

        return $userPermissions;
    }
}
