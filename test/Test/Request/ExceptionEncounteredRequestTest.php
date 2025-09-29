<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Test\Request;

use MaxBeckers\AmazonAlexa\Request\Request;
use MaxBeckers\AmazonAlexa\Request\Request\System\ExceptionEncounteredRequest;
use PHPUnit\Framework\TestCase;

class ExceptionEncounteredRequestTest extends TestCase
{
    public function testExceptionEncounteredRequest(): void
    {
        $requestBody = file_get_contents(__DIR__ . '/RequestData/systemError.json');
        $request = Request::fromAmazonRequest($requestBody, 'https://s3.amazonaws.com/echo.api/echo-api-cert.pem', 'signature');
        $this->assertInstanceOf(ExceptionEncounteredRequest::class, $request->request);
    }

    public function testExceptionEncounteredRequestWithNumericTimestamp(): void
    {
        $requestBody = json_decode(file_get_contents(__DIR__ . '/RequestData/systemError.json'), true);
        $requestBody['request']['timestamp'] = 65545900;
        $requestBody = json_encode($requestBody);
        $request = Request::fromAmazonRequest($requestBody, 'https://s3.amazonaws.com/echo.api/echo-api-cert.pem', 'signature');
        $this->assertInstanceOf(ExceptionEncounteredRequest::class, $request->request);
    }
}
