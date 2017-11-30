<?php

use MaxBeckers\AmazonAlexa\Request\Request;
use MaxBeckers\AmazonAlexa\Request\Request\Standard\LaunchRequest;
use PHPUnit\Framework\TestCase;

/**
 * @author Maximilian Beckers <beckers.maximilian@gmail.com>
 */
class LaunchRequestTest extends TestCase
{
    public function testLaunchRequest()
    {
        $requestBody = file_get_contents(__DIR__.'/RequestData/launch.json');
        $request     = Request::fromAmazonRequest($requestBody, 'https://s3.amazonaws.com/echo.api/echo-api-cert.pem', 'signature');
        $this->assertInstanceOf(LaunchRequest::class, $request->request);
    }
}
