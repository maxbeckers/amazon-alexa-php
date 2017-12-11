<?php

namespace MaxBeckers\AmazonAlexa\Request;

/**
 * @author Maximilian Beckers <beckers.maximilian@gmail.com>
 */
class Device
{
    /**
     * @var string|null
     */
    public $deviceId;

    /**
     * @var array
     */
    public $supportedInterfaces;

    /**
     * @var string|null
     */
    public $accessToken;

    /**
     * @param array $amazonRequest
     *
     * @return Device
     */
    public static function fromAmazonRequest(array $amazonRequest): self
    {
        $device = new self();

        $device->deviceId            = isset($amazonRequest['deviceId']) ? $amazonRequest['deviceId'] : null;
        $device->supportedInterfaces = isset($amazonRequest['supportedInterfaces']) ? (array) $amazonRequest['supportedInterfaces'] : [];
        $device->accessToken         = isset($amazonRequest['accessToken']) ? $amazonRequest['accessToken'] : null;

        return $device;
    }
}
