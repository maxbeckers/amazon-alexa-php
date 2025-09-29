<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Helper;

use GuzzleHttp\Client;
use MaxBeckers\AmazonAlexa\Exception\DeviceApiCallException;
use MaxBeckers\AmazonAlexa\Exception\MissingRequestDataException;
use MaxBeckers\AmazonAlexa\Request\Device\DeviceAddressInformation;
use MaxBeckers\AmazonAlexa\Request\Request;

/**
 * This helper class can call the amazon api to get address information.
 * For more details @see https=>//developer.amazon.com/de/docs/custom-skills/device-address-api.html.
 */
class DeviceAddressInformationHelper
{
    public function __construct(
        private readonly Client $client = new Client()
    ) {
    }

    /**
     * @throws MissingRequestDataException
     */
    public function getCountryAndPostalCode(Request $request): DeviceAddressInformation
    {
        if (!isset($request->context->system->device->deviceId, $request->context->system->apiAccessToken, $request->context->system->apiEndpoint)) {
            throw new MissingRequestDataException();
        }

        $deviceId = $request->context->system->device->deviceId;
        $token = $request->context->system->apiAccessToken;
        $endpoint = $request->context->system->apiEndpoint;

        $url = sprintf('%s/v1/devices/%s/settings/address/countryAndPostalCode', $endpoint, $deviceId);

        return $this->apiCall($url, $token);
    }

    /**
     * @throws MissingRequestDataException
     */
    public function getAddress(Request $request): DeviceAddressInformation
    {
        if (!isset($request->context->system->device->deviceId, $request->context->system->apiAccessToken, $request->context->system->apiEndpoint)) {
            throw new MissingRequestDataException();
        }

        $deviceId = $request->context->system->device->deviceId;
        $token = $request->context->system->apiAccessToken;
        $endpoint = $request->context->system->apiEndpoint;

        $url = sprintf('%s/v1/devices/%s/settings/address', $endpoint, $deviceId);

        return $this->apiCall($url, $token);
    }

    /**
     * @throws DeviceApiCallException
     */
    private function apiCall(string $url, string $token): DeviceAddressInformation
    {
        $response = $this->client->request('GET', $url, [
            'headers' => [
                'Authorization' => 'Bearer ' . $token,
                'Accept' => 'application/json',
            ],
        ]);

        /*
         * Api Call response codes:
         * 200 OK                   Successfully got the address associated with this deviceId.
         * 204 No Content           The query did not return any results.
         * 403 Forbidden            The authentication token is invalid or doesn’t have access to the resource.
         * 405 Method Not Allowed   The method is not supported.
         * 429 Too Many Requests    The skill has been throttled due to an excessive number of requests.
         * 500 Internal Error       An unexpected error occurred.
         */
        if (200 !== $response->getStatusCode()) {
            throw new DeviceApiCallException(sprintf('Error in api call (status code:"%s")', $response->getStatusCode()));
        }

        return DeviceAddressInformation::fromApiResponse(json_decode($response->getBody()->getContents(), true));
    }
}
