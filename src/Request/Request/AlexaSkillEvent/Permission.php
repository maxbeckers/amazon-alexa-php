<?php

namespace MaxBeckers\AmazonAlexa\Request\Request\AlexaSkillEvent;

use MaxBeckers\AmazonAlexa\Helper\PropertyHelper;

/**
 * @author Maximilian Beckers <beckers.maximilian@gmail.com>
 */
class Permission
{
    /**
     * @var string|null
     */
    public $scope;

    /**
     * @param array $amazonRequest
     *
     * @return Permission
     */
    public static function fromAmazonRequest(array $amazonRequest): self
    {
        $permission = new self();

        $permission->scope = PropertyHelper::checkNullValueString($amazonRequest, 'scope');

        return $permission;
    }
}
