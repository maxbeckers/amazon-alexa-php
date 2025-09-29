<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Request;

class Altitude
{
    public float $altitudeInMeters;
    public ?float $accuracyInMeters = null;

    public static function fromAmazonRequest(array $amazonRequest): self
    {
        $altitude = new self();

        $altitude->altitudeInMeters = (float) ($amazonRequest['altitudeInMeters']);
        $altitude->accuracyInMeters = isset($amazonRequest['accuracyInMeters']) ? (float) ($amazonRequest['accuracyInMeters']) : null;

        return $altitude;
    }
}
