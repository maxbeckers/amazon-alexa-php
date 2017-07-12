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
        $requestHeaders = [
            'Signature'             => '',
            'SignatureCertChainUrl' => 'https://s3.amazonaws.com/echo.api/echo-api-cert.pem',
        ];
        $requestBody    = file_get_contents(__DIR__.'/RequestData/launch.json');
        $request        = Request::fromAmazonRequest($requestHeaders, $requestBody);
        $this->assertInstanceOf(LaunchRequest::class, $request->request);
    }
}
