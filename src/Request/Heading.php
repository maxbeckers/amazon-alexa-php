<?php

namespace MaxBeckers\AmazonAlexa\Request;

/**
 * @author Brandon Olivares <programmer2188@gmail.com>
 */
class Heading
{
    /**
     * @var float
     */
    public $directionInDegrees;

    /**
     * @var float|null
     */
    public $accuracyInDegrees;

    /**
     * @param array $amazonRequest
     *
     * @return Heading
     */
    public static function fromAmazonRequest(array $amazonRequest): self
    {
        $heading = new self();

        $heading->directionInDegrees = floatval($amazonRequest['directionInDegrees']);
        $heading->accuracyInDegrees  = isset($amazonRequest['accuracyInDegrees']) ? floatval($amazonRequest['accuracyInDegrees']) : null;

        return $heading;
    }
}
