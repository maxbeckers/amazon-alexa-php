<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Request;

/**
 * @deprecated
 */
class Heading
{
    /**
     * @param float $directionInDegrees Direction in degrees
     * @param float|null $accuracyInDegrees Accuracy of direction in degrees
     */
    public function __construct(
        public float $directionInDegrees,
        public ?float $accuracyInDegrees = null,
    ) {
    }

    public static function fromAmazonRequest(array $amazonRequest): self
    {
        return new self(
            directionInDegrees: (float) ($amazonRequest['directionInDegrees']),
            accuracyInDegrees: isset($amazonRequest['accuracyInDegrees']) ? (float) ($amazonRequest['accuracyInDegrees']) : null,
        );
    }
}
