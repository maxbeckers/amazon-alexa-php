<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Request;

/**
 * @deprecated
 */
class Speed
{
    /**
     * @param float $speedInMetersPerSecond Speed in meters per second
     * @param float|null $accuracyInMetersPerSecond Accuracy of speed measurement in meters per second
     */
    public function __construct(
        public float $speedInMetersPerSecond,
        public ?float $accuracyInMetersPerSecond = null,
    ) {
    }

    public static function fromAmazonRequest(array $amazonRequest): self
    {
        return new self(
            speedInMetersPerSecond: (float) ($amazonRequest['speedInMetersPerSecond']),
            accuracyInMetersPerSecond: isset($amazonRequest['accuracyInMetersPerSecond']) ? (float) ($amazonRequest['accuracyInMetersPerSecond']) : null,
        );
    }
}
