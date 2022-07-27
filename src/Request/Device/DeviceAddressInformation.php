<?php

namespace MaxBeckers\AmazonAlexa\Request\Device;

use MaxBeckers\AmazonAlexa\Helper\PropertyHelper;

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

        $deviceAddressInformation->stateOrRegion    = PropertyHelper::checkNullValue($amazonApiResponse, 'stateOrRegion');
        $deviceAddressInformation->city             = PropertyHelper::checkNullValue($amazonApiResponse, 'city');
        $deviceAddressInformation->countryCode      = PropertyHelper::checkNullValue($amazonApiResponse, 'countryCode');
        $deviceAddressInformation->postalCode       = PropertyHelper::checkNullValue($amazonApiResponse, 'postalCode');
        $deviceAddressInformation->addressLine1     = PropertyHelper::checkNullValue($amazonApiResponse, 'addressLine1');
        $deviceAddressInformation->addressLine2     = PropertyHelper::checkNullValue($amazonApiResponse, 'addressLine2');
        $deviceAddressInformation->addressLine3     = PropertyHelper::checkNullValue($amazonApiResponse, 'addressLine3');
        $deviceAddressInformation->districtOrCounty = PropertyHelper::checkNullValue($amazonApiResponse, 'districtOrCounty');

        return $deviceAddressInformation;
    }
}
