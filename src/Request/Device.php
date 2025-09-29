<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Request;

use MaxBeckers\AmazonAlexa\Helper\PropertyHelper;

class Device
{
    public ?string $deviceId = null;
    public array $supportedInterfaces = [];
    public ?string $accessToken = null;

    public static function fromAmazonRequest(array $amazonRequest): self
    {
        $device = new self();

        $device->deviceId = PropertyHelper::checkNullValueString($amazonRequest, 'deviceId');
        $device->supportedInterfaces = $amazonRequest['supportedInterfaces'] ?? [];
        $device->accessToken = PropertyHelper::checkNullValueString($amazonRequest, 'accessToken');

        return $device;
    }
}
