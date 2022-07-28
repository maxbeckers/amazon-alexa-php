<?php

namespace MaxBeckers\AmazonAlexa\Request;

use MaxBeckers\AmazonAlexa\Helper\PropertyHelper;

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

        $userPermissions->consentToken = PropertyHelper::checkNullValue($amazonRequest, 'consentToken');

        return $userPermissions;
    }
}
