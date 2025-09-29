<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Test\Request;

use MaxBeckers\AmazonAlexa\Exception\MissingRequestDataException;
use MaxBeckers\AmazonAlexa\Exception\MissingRequiredHeaderException;
use MaxBeckers\AmazonAlexa\Request\Request;
use MaxBeckers\AmazonAlexa\Request\Request\Standard\IntentRequest;
use PHPUnit\Framework\TestCase;

class IntentRequestTest extends TestCase
{
    public function testMissingRequestData(): void
    {
        $this->expectException(MissingRequestDataException::class);
        Request::fromAmazonRequest('', '', '');
    }

    public function testMissingRequestHeaders(): void
    {
        $this->expectException(MissingRequiredHeaderException::class);
        $requestBody = file_get_contents(__DIR__ . '/RequestData/intent.json');
        Request::fromAmazonRequest($requestBody, '', '');
    }

    public function testIntentRequest(): void
    {
        $requestBody = file_get_contents(__DIR__ . '/RequestData/intent.json');
        $request = Request::fromAmazonRequest($requestBody, 'https://s3.amazonaws.com/echo.api/echo-api-cert.pem', 'signature');
        $this->assertInstanceOf(IntentRequest::class, $request->request);
        $this->assertSame('my-application-id', $request->context->system->application->applicationId);
    }

    public function testIntentRequestShouldGetApplicationId(): void
    {
        $requestBody = file_get_contents(__DIR__ . '/RequestData/intent.json');
        $request = Request::fromAmazonRequest($requestBody, 'https://s3.amazonaws.com/echo.api/echo-api-cert.pem', 'signature');
        $this->assertInstanceOf(IntentRequest::class, $request->request);
        $this->assertSame('applicationId', $request->getApplicationId());
    }

    public function testIntentRequestWithNumericTimestamp(): void
    {
        $requestBody = json_decode(file_get_contents(__DIR__ . '/RequestData/intent.json'), true);
        $requestBody['request']['timestamp'] = 65545900;
        $requestBody = json_encode($requestBody);
        $request = Request::fromAmazonRequest($requestBody, 'https://s3.amazonaws.com/echo.api/echo-api-cert.pem', 'signature');
        $this->assertInstanceOf(IntentRequest::class, $request->request);
        $this->assertSame('my-application-id', $request->context->system->application->applicationId);
    }
}
