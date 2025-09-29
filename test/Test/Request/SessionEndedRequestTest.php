<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Test\Request;

use MaxBeckers\AmazonAlexa\Request\Request;
use MaxBeckers\AmazonAlexa\Request\Request\Standard\SessionEndedRequest;
use PHPUnit\Framework\TestCase;

class SessionEndedRequestTest extends TestCase
{
    public function testSessionEndedRequestRequest(): void
    {
        $requestBody = file_get_contents(__DIR__ . '/RequestData/sessionEnded.json');
        $request = Request::fromAmazonRequest($requestBody, 'https://s3.amazonaws.com/echo.api/echo-api-cert.pem', 'signature');
        $this->assertInstanceOf(SessionEndedRequest::class, $request->request);
    }
}
