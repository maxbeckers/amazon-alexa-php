<?php

namespace MaxBeckers\AmazonAlexa\Request;

/**
 * @author Brandon Olivares <programmer2188@gmail.com>
 */
class Altitude
{
    /**
     * @var float
     */
    public $altitudeInMeters;

    /**
     * @var float|null
     */
    public $accuracyInMeters;

    /**
     * @param array $amazonRequest
     *
     * @return Altitude
     */
    public static function fromAmazonRequest(array $amazonRequest): Altitude
    {
        $altitude = new self();

        $altitude->altitudeInMeters = floatval($amazonRequest['altitudeInMeters']);
        $altitude->accuracyInMeters = isset($amazonRequest['accuracyInMeters']) ? floatval($amazonRequest['accuracyInMeters']) : null;

        return $altitude;
    }
}
