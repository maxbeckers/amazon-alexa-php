<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Request;

/**
 * @deprecated
 */
class Altitude
{
    /**
     * @param float $altitudeInMeters Altitude in meters
     * @param float|null $accuracyInMeters Accuracy of altitude measurement in meters
     */
    public function __construct(
        public float $altitudeInMeters,
        public ?float $accuracyInMeters = null,
    ) {
    }

    public static function fromAmazonRequest(array $amazonRequest): self
    {
        return new self(
            altitudeInMeters: (float) ($amazonRequest['altitudeInMeters']),
            accuracyInMeters: isset($amazonRequest['accuracyInMeters']) ? (float) ($amazonRequest['accuracyInMeters']) : null,
        );
    }
}
