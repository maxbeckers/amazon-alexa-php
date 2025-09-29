<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Request;

class LocationServices
{
    public const ACCESS_ENABLED = 'ENABLED';
    public const ACCESS_DISABLED = 'DISABLED';

    public const STATUS_RUNNING = 'RUNNING';
    public const STATUS_STOPPED = 'STOPPED';

    public string $access;
    public string $status;

    public static function fromAmazonRequest(array $amazonRequest): self
    {
        $locationServices = new self();

        $locationServices->access = $amazonRequest['access'];
        $locationServices->status = $amazonRequest['status'];

        return $locationServices;
    }
}
