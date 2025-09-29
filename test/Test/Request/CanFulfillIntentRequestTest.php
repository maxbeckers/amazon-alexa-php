<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Test\Request;

use MaxBeckers\AmazonAlexa\Request\Request;
use MaxBeckers\AmazonAlexa\Request\Request\CanFulfill\CanFulfillIntentRequest;
use PHPUnit\Framework\TestCase;

class CanFulfillIntentRequestTest extends TestCase
{
    public function testIntentRequest(): void
    {
        $requestBody = file_get_contents(__DIR__ . '/RequestData/can_fulfill_intent.json');
        $request = Request::fromAmazonRequest($requestBody, 'https://s3.amazonaws.com/echo.api/echo-api-cert.pem', 'signature');
        $this->assertInstanceOf(CanFulfillIntentRequest::class, $request->request);
        $this->assertSame(CanFulfillIntentRequest::TYPE, $request->request->type);
    }
}
