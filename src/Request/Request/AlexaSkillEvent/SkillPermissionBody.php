<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Request\Request\AlexaSkillEvent;

class SkillPermissionBody
{
    /**
     * @param Permission[] $acceptedPermissions Array of accepted permissions
     */
    public function __construct(
        public array $acceptedPermissions = [],
    ) {
    }

    public static function fromAmazonRequest(array $amazonRequest): self
    {
        $acceptedPermissions = [];

        if (isset($amazonRequest['acceptedPermissions']) && is_array($amazonRequest['acceptedPermissions'])) {
            foreach ($amazonRequest['acceptedPermissions'] as $permission) {
                $acceptedPermissions[] = Permission::fromAmazonRequest($permission);
            }
        }

        return new self(
            acceptedPermissions: $acceptedPermissions,
        );
    }
}
