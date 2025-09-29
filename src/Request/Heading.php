<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Request;

class Heading
{
    public float $directionInDegrees;
    public ?float $accuracyInDegrees = null;

    public static function fromAmazonRequest(array $amazonRequest): self
    {
        $heading = new self();

        $heading->directionInDegrees = (float) ($amazonRequest['directionInDegrees']);
        $heading->accuracyInDegrees = isset($amazonRequest['accuracyInDegrees']) ? (float) ($amazonRequest['accuracyInDegrees']) : null;

        return $heading;
    }
}
