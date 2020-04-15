<?php

namespace MaxBeckers\AmazonAlexa\Request\Request\AlexaSkillEvent;

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

        $permission->scope = isset($amazonRequest['scope']) ? $amazonRequest['scope'] : null;

        return $permission;
    }
}
