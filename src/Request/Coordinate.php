<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Request;

class Coordinate
{
    public float $latitudeInDegrees;
    public float $longitudeInDegrees;
    public float $accuracyInMeters;

    public static function fromAmazonRequest(array $amazonRequest): self
    {
        $coordinate = new self();

        $coordinate->latitudeInDegrees = (float) ($amazonRequest['latitudeInDegrees']);
        $coordinate->longitudeInDegrees = (float) ($amazonRequest['longitudeInDegrees']);
        $coordinate->accuracyInMeters = (float) ($amazonRequest['accuracyInMeters']);

        return $coordinate;
    }
}
