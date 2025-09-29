<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Request;

class Speed
{
    public float $speedInMetersPerSecond;
    public ?float $accuracyInMetersPerSecond = null;

    public static function fromAmazonRequest(array $amazonRequest): self
    {
        $speed = new self();

        $speed->speedInMetersPerSecond = (float) ($amazonRequest['speedInMetersPerSecond']);
        $speed->accuracyInMetersPerSecond = isset($amazonRequest['accuracyInMetersPerSecond']) ? (float) ($amazonRequest['accuracyInMetersPerSecond']) : null;

        return $speed;
    }
}
