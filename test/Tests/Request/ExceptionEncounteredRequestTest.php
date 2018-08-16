<?php

namespace MaxBeckers\AmazonAlexa\Tests;

use MaxBeckers\AmazonAlexa\Request\Request;
use MaxBeckers\AmazonAlexa\Request\Request\System\ExceptionEncounteredRequest;
use PHPUnit\Framework\TestCase;

/**
 * @author Maximilian Beckers <beckers.maximilian@gmail.com>
 */
class ExceptionEncounteredRequestTest extends TestCase
{
    public function testExceptionEncounteredRequest()
    {
        $requestBody = file_get_contents(__DIR__.'/RequestData/systemError.json');
        $request     = Request::fromAmazonRequest($requestBody, 'https://s3.amazonaws.com/echo.api/echo-api-cert.pem', 'signature');
        $this->assertInstanceOf(ExceptionEncounteredRequest::class, $request->request);
    }

    public function testExceptionEncounteredRequestWithNumericTimestamp()
    {
        $requestBody                         = json_decode(file_get_contents(__DIR__.'/RequestData/systemError.json'), true);
        $requestBody['request']['timestamp'] = 65545900;
        $requestBody                         = json_encode($requestBody);
        $request                             = Request::fromAmazonRequest($requestBody, 'https://s3.amazonaws.com/echo.api/echo-api-cert.pem', 'signature');
        $this->assertInstanceOf(ExceptionEncounteredRequest::class, $request->request);
    }
}
