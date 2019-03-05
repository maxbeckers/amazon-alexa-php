<?php

namespace MaxBeckers\AmazonAlexa\Request\Device;

/**
 * @author Maximilian Beckers <beckers.maximilian@gmail.com>
 */
class DeviceAddressInformation
{
    /**
     * @var string|null
     */
    public $stateOrRegion;

    /**
     * @var string|null
     */
    public $city;

    /**
     * @var string|null
     */
    public $countryCode;

    /**
     * @var string|null
     */
    public $postalCode;

    /**
     * @var string|null
     */
    public $addressLine1;

    /**
     * @var string|null
     */
    public $addressLine2;

    /**
     * @var string|null
     */
    public $addressLine3;

    /**
     * @var string|null
     */
    public $districtOrCounty;

    /**
     * @param array $amazonApiResponse
     *
     * @return DeviceAddressInformation
     */
    public static function fromApiResponse(array $amazonApiResponse): self
    {
        $deviceAddressInformation = new self();

        $deviceAddressInformation->stateOrRegion    = isset($amazonApiResponse['stateOrRegion']) ? $amazonApiResponse['stateOrRegion'] : null;
        $deviceAddressInformation->city             = isset($amazonApiResponse['city']) ? $amazonApiResponse['city'] : null;
        $deviceAddressInformation->countryCode      = isset($amazonApiResponse['countryCode']) ? $amazonApiResponse['countryCode'] : null;
        $deviceAddressInformation->postalCode       = isset($amazonApiResponse['postalCode']) ? $amazonApiResponse['postalCode'] : null;
        $deviceAddressInformation->addressLine1     = isset($amazonApiResponse['addressLine1']) ? $amazonApiResponse['addressLine1'] : null;
        $deviceAddressInformation->addressLine2     = isset($amazonApiResponse['addressLine2']) ? $amazonApiResponse['addressLine2'] : null;
        $deviceAddressInformation->addressLine3     = isset($amazonApiResponse['addressLine3']) ? $amazonApiResponse['addressLine3'] : null;
        $deviceAddressInformation->districtOrCounty = isset($amazonApiResponse['districtOrCounty']) ? $amazonApiResponse['districtOrCounty'] : null;

        return $deviceAddressInformation;
    }
}
