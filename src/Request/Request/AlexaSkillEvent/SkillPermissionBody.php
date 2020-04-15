<?php

namespace MaxBeckers\AmazonAlexa\Request\Request\AlexaSkillEvent;

/**
 * @author Maximilian Beckers <beckers.maximilian@gmail.com>
 */
class SkillPermissionBody
{
    /**
     * @var array
     */
    public $acceptedPermissions;

    /**
     * @param array $amazonRequest
     *
     * @return SkillPermissionBody
     */
    public static function fromAmazonRequest(array $amazonRequest): self
    {
        $body = new self();

        $body->acceptedPermissions = [];

        if ($amazonRequest['acceptedPermissions']) {
            foreach ($amazonRequest['acceptedPermissions'] as $permission) {
                $body->acceptedPermissions[] = Permission::fromAmazonRequest($permission);
            }
        }

        return $body;
    }
}
