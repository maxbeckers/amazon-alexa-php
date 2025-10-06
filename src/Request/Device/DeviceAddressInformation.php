<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Request\Device;

use MaxBeckers\AmazonAlexa\Helper\PropertyHelper;

class DeviceAddressInformation
{
    /**
     * @param string|null $stateOrRegion State or region
     * @param string|null $city City name
     * @param string|null $countryCode Country code
     * @param string|null $postalCode Postal code
     * @param string|null $addressLine1 First address line
     * @param string|null $addressLine2 Second address line
     * @param string|null $addressLine3 Third address line
     * @param string|null $districtOrCounty District or county
     */
    public function __construct(
        public ?string $stateOrRegion = null,
        public ?string $city = null,
        public ?string $countryCode = null,
        public ?string $postalCode = null,
        public ?string $addressLine1 = null,
        public ?string $addressLine2 = null,
        public ?string $addressLine3 = null,
        public ?string $districtOrCounty = null,
    ) {
    }

    public static function fromApiResponse(array $amazonApiResponse): self
    {
        return new self(
            stateOrRegion: PropertyHelper::checkNullValueString($amazonApiResponse, 'stateOrRegion'),
            city: PropertyHelper::checkNullValueString($amazonApiResponse, 'city'),
            countryCode: PropertyHelper::checkNullValueString($amazonApiResponse, 'countryCode'),
            postalCode: PropertyHelper::checkNullValueString($amazonApiResponse, 'postalCode'),
            addressLine1: PropertyHelper::checkNullValueString($amazonApiResponse, 'addressLine1'),
            addressLine2: PropertyHelper::checkNullValueString($amazonApiResponse, 'addressLine2'),
            addressLine3: PropertyHelper::checkNullValueString($amazonApiResponse, 'addressLine3'),
            districtOrCounty: PropertyHelper::checkNullValueString($amazonApiResponse, 'districtOrCounty'),
        );
    }
}
