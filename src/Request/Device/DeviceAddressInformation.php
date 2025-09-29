<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Request\Device;

use MaxBeckers\AmazonAlexa\Helper\PropertyHelper;

class DeviceAddressInformation
{
    public ?string $stateOrRegion;
    public ?string $city;
    public ?string $countryCode;
    public ?string $postalCode;
    public ?string $addressLine1;
    public ?string $addressLine2;
    public ?string $addressLine3;
    public ?string $districtOrCounty;

    public static function fromApiResponse(array $amazonApiResponse): self
    {
        $deviceAddressInformation = new self();

        $deviceAddressInformation->stateOrRegion = PropertyHelper::checkNullValueString($amazonApiResponse, 'stateOrRegion');
        $deviceAddressInformation->city = PropertyHelper::checkNullValueString($amazonApiResponse, 'city');
        $deviceAddressInformation->countryCode = PropertyHelper::checkNullValueString($amazonApiResponse, 'countryCode');
        $deviceAddressInformation->postalCode = PropertyHelper::checkNullValueString($amazonApiResponse, 'postalCode');
        $deviceAddressInformation->addressLine1 = PropertyHelper::checkNullValueString($amazonApiResponse, 'addressLine1');
        $deviceAddressInformation->addressLine2 = PropertyHelper::checkNullValueString($amazonApiResponse, 'addressLine2');
        $deviceAddressInformation->addressLine3 = PropertyHelper::checkNullValueString($amazonApiResponse, 'addressLine3');
        $deviceAddressInformation->districtOrCounty = PropertyHelper::checkNullValueString($amazonApiResponse, 'districtOrCounty');

        return $deviceAddressInformation;
    }
}
