<?php

namespace MaxBeckers\AmazonAlexa\Request;

use MaxBeckers\AmazonAlexa\Helper\PropertyHelper;

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

        $device->deviceId            = PropertyHelper::checkNullValueString($amazonRequest, 'deviceId');
        $device->supportedInterfaces = isset($amazonRequest['supportedInterfaces']) ? (array) $amazonRequest['supportedInterfaces'] : [];
        $device->accessToken         = PropertyHelper::checkNullValueString($amazonRequest, 'accessToken');

        return $device;
    }
}
