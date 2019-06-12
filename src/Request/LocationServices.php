<?php

namespace MaxBeckers\AmazonAlexa\Request;

/**
 * @author Brandon Olivares <programmer2188@gmail.com>
 */
class LocationServices
{
    const ACCESS_ENABLED = 'ENABLED';
    const ACCESS_DISABLED = 'DISABLED';

    const STATUS_RUNNING = 'RUNNING';
    const STATUS_STOPPED = 'STOPPED';

    /**
     * @var string
     */
    public $access;

    /**
     * @var string
     */
    public $status;

    /**
     * @param array $amazonRequest
     *
     * @return LocationServices
     */
    public static function fromAmazonRequest(array $amazonRequest): self
    {
        $locationServices = new self();

        $locationServices->access   = $amazonRequest['access'];
        $locationServices->status   = $amazonRequest['status'];

        return $locationServices;
    }
}
