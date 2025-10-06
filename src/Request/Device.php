<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Request;

use MaxBeckers\AmazonAlexa\Helper\PropertyHelper;

class Device
{
    /**
     * @param string|null $deviceId Device identifier
     * @param array $supportedInterfaces Array of supported interfaces
     * @param string|null $accessToken Access token for the device
     */
    public function __construct(
        public ?string $deviceId = null,
        public array $supportedInterfaces = [],
        public ?string $accessToken = null,
    ) {
    }

    public static function fromAmazonRequest(array $amazonRequest): self
    {
        return new self(
            deviceId: PropertyHelper::checkNullValueString($amazonRequest, 'deviceId'),
            supportedInterfaces: $amazonRequest['supportedInterfaces'] ?? [],
            accessToken: PropertyHelper::checkNullValueString($amazonRequest, 'accessToken'),
        );
    }
}
