<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Request;

/**
 * @deprecated
 */
class Coordinate
{
    /**
     * @param float $latitudeInDegrees Latitude in degrees
     * @param float $longitudeInDegrees Longitude in degrees
     * @param float $accuracyInMeters Accuracy in meters
     */
    public function __construct(
        public float $latitudeInDegrees,
        public float $longitudeInDegrees,
        public float $accuracyInMeters,
    ) {
    }

    public static function fromAmazonRequest(array $amazonRequest): self
    {
        return new self(
            latitudeInDegrees: (float) ($amazonRequest['latitudeInDegrees']),
            longitudeInDegrees: (float) ($amazonRequest['longitudeInDegrees']),
            accuracyInMeters: (float) ($amazonRequest['accuracyInMeters']),
        );
    }
}
