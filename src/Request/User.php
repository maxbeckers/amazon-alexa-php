<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Request;

use MaxBeckers\AmazonAlexa\Helper\PropertyHelper;

class User
{
    /**
     * @param string|null $userId User identifier
     * @param UserPermissions|null $permissions User permissions
     * @param string|null $accessToken User access token
     */
    public function __construct(
        public ?string $userId = null,
        public ?UserPermissions $permissions = null,
        public ?string $accessToken = null,
    ) {
    }

    public static function fromAmazonRequest(array $amazonRequest): self
    {
        return new self(
            userId: PropertyHelper::checkNullValueString($amazonRequest, 'userId'),
            permissions: isset($amazonRequest['permissions']) ? UserPermissions::fromAmazonRequest($amazonRequest['permissions']) : null,
            accessToken: PropertyHelper::checkNullValueString($amazonRequest, 'accessToken'),
        );
    }
}
