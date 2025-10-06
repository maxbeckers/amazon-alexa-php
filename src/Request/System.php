<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Request;

use MaxBeckers\AmazonAlexa\Helper\PropertyHelper;

class System
{
    /**
     * @param Application|null $application Application information
     * @param User|null $user User information
     * @param Device|null $device Device information
     * @param string|null $apiAccessToken API access token
     * @param string|null $apiEndpoint API endpoint
     */
    public function __construct(
        public ?Application $application = null,
        public ?User $user = null,
        public ?Device $device = null,
        public ?string $apiAccessToken = null,
        public ?string $apiEndpoint = null,
    ) {
    }

    /**
     * @param array $amazonRequest
     *
     * @return System
     */
    public static function fromAmazonRequest(array $amazonRequest): self
    {
        return new self(
            application: isset($amazonRequest['application']) ? Application::fromAmazonRequest($amazonRequest['application']) : null,
            user: isset($amazonRequest['user']) ? User::fromAmazonRequest($amazonRequest['user']) : null,
            device: isset($amazonRequest['device']) ? Device::fromAmazonRequest($amazonRequest['device']) : null,
            apiAccessToken: PropertyHelper::checkNullValueString($amazonRequest, 'apiAccessToken'),
            apiEndpoint: PropertyHelper::checkNullValueString($amazonRequest, 'apiEndpoint'),
        );
    }
}
