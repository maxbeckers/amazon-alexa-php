<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Request\Request\AlexaSkillEvent;

class SkillPermissionBody
{
    /** @var Permission[] */
    public array $acceptedPermissions = [];

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
