<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Request;

class Advertising
{
    /**
     * @param string|null $advertisingId The advertising identifier
     * @param bool|null $limitAdTracking Whether ad tracking is limited
     */
    public function __construct(
        public ?string $advertisingId = null,
        public ?bool $limitAdTracking = null,
    ) {
    }

    public static function fromAmazonRequest(array $amazonRequest): self
    {
        return new self(
            advertisingId: $amazonRequest['advertisingId'] ?? null,
            limitAdTracking: $amazonRequest['limitAdTracking'] ?? null,
        );
    }
}
