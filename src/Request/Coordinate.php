<?php

namespace MaxBeckers\AmazonAlexa\Request;

/**
 * @author Brandon Olivares <programmer2188@gmail.com>
 */
class Coordinate
{
    /**
     * @var float
     */
    public $latitudeInDegrees;

    /**
     * @var float
     */
    public $longitudeInDegrees;

    /**
     * @var float
     */
    public $accuracyInMeters;

    /**
     * @param array $amazonRequest
     *
     * @return Coordinate
     */
    public static function fromAmazonRequest(array $amazonRequest): self
    {
        $coordinate = new self();

        $coordinate->latitudeInDegrees  = floatval($amazonRequest['latitudeInDegrees']);
        $coordinate->longitudeInDegrees = floatval($amazonRequest['longitudeInDegrees']);
        $coordinate->accuracyInMeters   = floatval($amazonRequest['accuracyInMeters']);

        return $coordinate;
    }
}
