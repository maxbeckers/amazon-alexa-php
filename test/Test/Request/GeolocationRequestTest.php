<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Test\Request;

use MaxBeckers\AmazonAlexa\Request\Request;
use MaxBeckers\AmazonAlexa\Request\Request\Standard\IntentRequest;
use MaxBeckers\AmazonAlexa\Response\Card;
use PHPUnit\Framework\TestCase;

class GeolocationRequestTest extends TestCase
{
    public function testGeolocationNeedsPermission(): void
    {
        $requestBody = file_get_contents(__DIR__ . '/RequestData/geolocationPermission.json');
        $request = Request::fromAmazonRequest($requestBody, 'https://s3.amazonaws.com/echo.api/echo-api-cert.pem', 'signature');
        $this->assertInstanceOf(IntentRequest::class, $request->request);
        $this->assertArrayHasKey('Geolocation', $request->context->system->device->supportedInterfaces);
        $this->assertNull($request->context->geolocation);

        // Create permissions card.
        $card = Card::createAskForPermissionsConsent([Card::PERMISSION_GEOLOCATION]);
        $this->assertInstanceOf(Card::class, $card);
    }

    public function testGetGeolocationData(): void
    {
        $requestBody = file_get_contents(__DIR__ . '/RequestData/geolocation.json');
        $request = Request::fromAmazonRequest($requestBody, 'https://s3.amazonaws.com/echo.api/echo-api-cert.pem', 'signature');
        $this->assertInstanceOf(IntentRequest::class, $request->request);
        $this->assertArrayHasKey('Geolocation', $request->context->system->device->supportedInterfaces);

        $geolocation = $request->context->geolocation;
        $this->assertNotNull($geolocation);

        $this->assertNotNull($geolocation->locationServices);
        $this->assertEquals('ENABLED', $geolocation->locationServices->access);
        $this->assertEquals('RUNNING', $geolocation->locationServices->status);
        $this->assertEquals(new \DateTime('2019-06-12T19:13:01+00:00'), $geolocation->timestamp);
        $this->assertNotNull($geolocation->coordinate);
        $this->assertEquals(40.3, $geolocation->coordinate->latitudeInDegrees);
        $this->assertEquals(-78.9, $geolocation->coordinate->longitudeInDegrees);
        $this->assertEquals(100, $geolocation->coordinate->accuracyInMeters);
        $this->assertNotNull($geolocation->altitude);
        $this->assertEquals(600, $geolocation->altitude->altitudeInMeters);
        $this->assertEquals(100, $geolocation->altitude->accuracyInMeters);
        $this->assertNotNull($geolocation->heading);
        $this->assertEquals(48.12, $geolocation->heading->directionInDegrees);
        $this->assertEquals(5, $geolocation->heading->accuracyInDegrees);
        $this->assertNotNull($geolocation->speed);
        $this->assertEquals(1, $geolocation->speed->speedInMetersPerSecond);
        $this->assertEquals(1.0, $geolocation->speed->accuracyInMetersPerSecond);
    }
}
