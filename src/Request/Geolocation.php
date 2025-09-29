<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Request;

class Geolocation
{
    public ?LocationServices $locationServices = null;
    public \DateTime $timestamp;
    public ?Coordinate $coordinate = null;
    public ?Altitude $altitude = null;
    public ?Heading $heading = null;
    public ?Speed $speed = null;

    /**
     * @param array $amazonRequest
     *
     * @return Geolocation
     */
    public static function fromAmazonRequest(array $amazonRequest): self
    {
        $geolocation = new self();

        $geolocation->locationServices = isset($amazonRequest['locationServices']) ? LocationServices::fromAmazonRequest($amazonRequest['locationServices']) : null;
        $geolocation->timestamp = new \DateTime($amazonRequest['timestamp']);
        $geolocation->coordinate = isset($amazonRequest['coordinate']) ? Coordinate::fromAmazonRequest($amazonRequest['coordinate']) : null;
        $geolocation->altitude = isset($amazonRequest['altitude']) ? Altitude::fromAmazonRequest($amazonRequest['altitude']) : null;
        $geolocation->heading = isset($amazonRequest['heading']) ? Heading::fromAmazonRequest($amazonRequest['heading']) : null;
        $geolocation->speed = isset($amazonRequest['speed']) ? Speed::fromAmazonRequest($amazonRequest['speed']) : null;

        return $geolocation;
    }
}
