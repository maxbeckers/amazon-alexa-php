<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Request;

use MaxBeckers\AmazonAlexa\Helper\PropertyHelper;

class UserPermissions
{
    /**
     * @param string|null $consentToken Consent token for user permissions
     */
    public function __construct(
        public ?string $consentToken = null,
    ) {
    }

    public static function fromAmazonRequest(array $amazonRequest): self
    {
        return new self(
            consentToken: PropertyHelper::checkNullValueString($amazonRequest, 'consentToken'),
        );
    }
}
