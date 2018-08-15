<?php

namespace MaxBeckers\AmazonAlexa\Tests;

use GuzzleHttp\Client;
use MaxBeckers\AmazonAlexa\Exception\DeviceApiCallException;
use MaxBeckers\AmazonAlexa\Exception\MissingRequestDataException;
use MaxBeckers\AmazonAlexa\Helper\DeviceAddressInformationHelper;
use MaxBeckers\AmazonAlexa\Request\Context;
use MaxBeckers\AmazonAlexa\Request\Device;
use MaxBeckers\AmazonAlexa\Request\Request;
use MaxBeckers\AmazonAlexa\Request\System;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

/**
 * @author Maximilian Beckers <beckers.maximilian@gmail.com>
 */
class DeviceAddressInformationHelperTest extends TestCase
{
    public function testGetCountryAndPostalCodeSuccess()
    {
        $responseData = [
            'countryCode' => 'US',
            'postalCode'  => '98109',
        ];

        $client          = $this->createMock(Client::class);
        $apiResponse     = $this->createMock(ResponseInterface::class);
        $apiResponseBody = $this->createMock(StreamInterface::class);

        $client->method('request')
             ->willReturn($apiResponse);
        $apiResponse->method('getStatusCode')
                    ->willReturn(200);
        $apiResponse->method('getBody')
                    ->willReturn($apiResponseBody);
        $apiResponseBody->method('getContents')
                    ->willReturn(json_encode($responseData));

        $deviceAddressInformationHelper = new DeviceAddressInformationHelper($client);
        $this->assertEquals(
            Device\DeviceAddressInformation::fromApiResponse($responseData),
            $deviceAddressInformationHelper->getCountryAndPostalCode($this->createDummyRequest('id', 'https://test.com', 'test'))
        );
    }

    public function testGetCountryAndPostalCodeError()
    {
        $client      = $this->createMock(Client::class);
        $apiResponse = $this->createMock(ResponseInterface::class);

        $client->method('request')
             ->willReturn($apiResponse);
        $apiResponse->method('getStatusCode')
                    ->willReturn(403);

        $deviceAddressInformationHelper = new DeviceAddressInformationHelper($client);
        $this->expectException(DeviceApiCallException::class);
        $deviceAddressInformationHelper->getCountryAndPostalCode($this->createDummyRequest('id', 'https://test.com', 'test'));
    }

    public function testGetCountryAndPostalCodeMissingData()
    {
        $client = $this->createMock(Client::class);

        $deviceAddressInformationHelper = new DeviceAddressInformationHelper($client);
        $this->expectException(MissingRequestDataException::class);
        $deviceAddressInformationHelper->getCountryAndPostalCode($this->createDummyRequest());
    }

    public function testGetAddressSuccess()
    {
        $responseData = [
            'stateOrRegion'    => 'WA',
            'city'             => 'Seattle',
            'countryCode'      => 'US',
            'postalCode'       => '98109',
            'addressLine1'     => '410 Terry Ave North',
            'addressLine2'     => '',
            'addressLine3'     => 'aeiou',
            'districtOrCounty' => '',
        ];

        $client          = $this->createMock(Client::class);
        $apiResponse     = $this->createMock(ResponseInterface::class);
        $apiResponseBody = $this->createMock(StreamInterface::class);

        $client->method('request')
             ->willReturn($apiResponse);
        $apiResponse->method('getStatusCode')
                    ->willReturn(200);
        $apiResponse->method('getBody')
                    ->willReturn($apiResponseBody);
        $apiResponseBody->method('getContents')
                    ->willReturn(json_encode($responseData));

        $deviceAddressInformationHelper = new DeviceAddressInformationHelper($client);
        $this->assertEquals(
            Device\DeviceAddressInformation::fromApiResponse($responseData),
            $deviceAddressInformationHelper->getAddress($this->createDummyRequest('id', 'https://test.com', 'test'))
        );
    }

    public function testGetAddressError()
    {
        $client      = $this->createMock(Client::class);
        $apiResponse = $this->createMock(ResponseInterface::class);

        $client->method('request')
               ->willReturn($apiResponse);
        $apiResponse->method('getStatusCode')
                    ->willReturn(500);

        $deviceAddressInformationHelper = new DeviceAddressInformationHelper($client);
        $this->expectException(DeviceApiCallException::class);
        $deviceAddressInformationHelper->getAddress($this->createDummyRequest('id', 'https://test.com', 'test'));
    }

    public function testGetAddressMissingData()
    {
        $client = $this->createMock(Client::class);

        $deviceAddressInformationHelper = new DeviceAddressInformationHelper($client);
        $this->expectException(MissingRequestDataException::class);
        $deviceAddressInformationHelper->getCountryAndPostalCode(new Request());
    }

    public function testGetAddressOnInvalidRequestInstance()
    {
        $client = $this->createMock(Client::class);

        $deviceAddressInformationHelper = new DeviceAddressInformationHelper($client);
        $this->expectException(MissingRequestDataException::class);
        $deviceAddressInformationHelper->getAddress(new Request());
    }

    /**
     * @param string $deviceId
     * @param string $apiEndpoint
     * @param string $apiAccessToken
     *
     * @return Request
     */
    private function createDummyRequest(string $deviceId = null, string $apiEndpoint = null, string $apiAccessToken = null): Request
    {
        $device           = new Device();
        $device->deviceId = $deviceId;

        $system                 = new System();
        $system->device         = $device;
        $system->apiEndpoint    = $apiEndpoint;
        $system->apiAccessToken = $apiAccessToken;

        $context         = new Context();
        $context->system = $system;

        $request          = new Request();
        $request->context = $context;

        return $request;
    }
}
