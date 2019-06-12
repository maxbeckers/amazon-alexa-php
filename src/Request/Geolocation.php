<?php

namespace MaxBeckers\AmazonAlexa\Request;

/**
 * @author Brandon Olivares <programmer2188@gmail.com>
 */
class Geolocation
{
    /**
     * @var LocationServices|null
     */
    public $locationServices;

    /**
     * @var \DateTime
     */
    public $timestamp;

    /**
     * @var Coordinate|null
     */
    public $coordinate;

    /**
     * @var Altitude|null
     */
    public $altitude;

    /**
     * @var Heading|null
     */
    public $heading;

    /**
     * @var Speed|null
     */
    public $speed;

    /**
     * @param array $amazonRequest
     *
     * @return Geolocation
     */
    public static function fromAmazonRequest(array $amazonRequest): self
    {
        $geolocation = new self();

        $geolocation->locationServices  = isset($amazonRequest['locationServices']) ? LocationServices::fromAmazonRequest($amazonRequest['locationServices']) : null;
        $geolocation->timestamp         = new \DateTime($amazonRequest['timestamp']);
        $geolocation->coordinate        = isset($amazonRequest['coordinate']) ? Coordinate::fromAmazonRequest($amazonRequest['coordinate']) : null;
        $geolocation->altitude          = isset($amazonRequest['altitude']) ? Altitude::fromAmazonRequest($amazonRequest['altitude']) : null;
        $geolocation->heading           = isset($amazonRequest['heading']) ? Heading::fromAmazonRequest($amazonRequest['heading']) : null;
        $geolocation->speed             = isset($amazonRequest['speed']) ? Speed::fromAmazonRequest($amazonRequest['speed']) : null;

        return $geolocation;
    }
}
