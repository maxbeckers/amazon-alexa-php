<?php

namespace MaxBeckers\AmazonAlexa\Request;

/**
 * @author Brandon Olivares <programmer2188@gmail.com>
 */
class Speed
{
    /**
     * @var float
     */
    public $speedInMetersPerSecond;

    /**
     * @var float|null
     */
    public $accuracyInMetersPerSecond;

    /**
     * @param array $amazonRequest
     *
     * @return Speed
     */
    public static function fromAmazonRequest(array $amazonRequest): Speed
    {
        $speed = new self();

        $speed->speedInMetersPerSecond = floatval($amazonRequest['speedInMetersPerSecond']);
        $speed->accuracyInMetersPerSecond = isset($amazonRequest['accuracyInMetersPerSecond']) ? floatval($amazonRequest['accuracyInMetersPerSecond']) : null;

        return $speed;
    }
}
