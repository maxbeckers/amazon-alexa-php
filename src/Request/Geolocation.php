<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Request;

/**
 * @deprecated
 */
class Geolocation
{
    /**
     * @param LocationServices|null $locationServices Location services information
     * @param \DateTime $timestamp Timestamp of the geolocation data
     * @param Coordinate|null $coordinate Coordinate information
     * @param Altitude|null $altitude Altitude information
     * @param Heading|null $heading Heading information
     * @param Speed|null $speed Speed information
     */
    public function __construct(
        public ?LocationServices $locationServices = null,
        public \DateTime $timestamp = new \DateTime(),
        public ?Coordinate $coordinate = null,
        public ?Altitude $altitude = null,
        public ?Heading $heading = null,
        public ?Speed $speed = null,
    ) {
    }

    /**
     * @param array $amazonRequest
     *
     * @return Geolocation
     */
    public static function fromAmazonRequest(array $amazonRequest): self
    {
        return new self(
            locationServices: isset($amazonRequest['locationServices']) ? LocationServices::fromAmazonRequest($amazonRequest['locationServices']) : null,
            timestamp: new \DateTime($amazonRequest['timestamp']),
            coordinate: isset($amazonRequest['coordinate']) ? Coordinate::fromAmazonRequest($amazonRequest['coordinate']) : null,
            altitude: isset($amazonRequest['altitude']) ? Altitude::fromAmazonRequest($amazonRequest['altitude']) : null,
            heading: isset($amazonRequest['heading']) ? Heading::fromAmazonRequest($amazonRequest['heading']) : null,
            speed: isset($amazonRequest['speed']) ? Speed::fromAmazonRequest($amazonRequest['speed']) : null,
        );
    }
}
