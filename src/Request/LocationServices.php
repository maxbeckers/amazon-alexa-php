<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Request;

/**
 * @deprecated
 */
class LocationServices
{
    public const ACCESS_ENABLED = 'ENABLED';
    public const ACCESS_DISABLED = 'DISABLED';

    public const STATUS_RUNNING = 'RUNNING';
    public const STATUS_STOPPED = 'STOPPED';

    /**
     * @param string $access Access status for location services
     * @param string $status Current status of location services
     */
    public function __construct(
        public string $access,
        public string $status,
    ) {
    }

    public static function fromAmazonRequest(array $amazonRequest): self
    {
        return new self(
            access: $amazonRequest['access'],
            status: $amazonRequest['status'],
        );
    }
}
