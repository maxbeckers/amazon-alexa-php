<?php

use MaxBeckers\AmazonAlexa\Exception\MissingRequiredHeaderException;
use MaxBeckers\AmazonAlexa\Request\Request;
use MaxBeckers\AmazonAlexa\Request\Request\Standard\SessionEndedRequest;
use PHPUnit\Framework\TestCase;

/**
 * @author Maximilian Beckers <beckers.maximilian@gmail.com>
 */
class SessionEndedRequestTest extends TestCase
{
    public function testSessionEndedRequestRequest()
    {
        $requestHeaders = [
            'Signature'             => '',
            'SignatureCertChainUrl' => 'https://s3.amazonaws.com/echo.api/echo-api-cert.pem',
        ];
        $requestBody    = file_get_contents(__DIR__.'/RequestData/sessionEnded.json');
        $request        = Request::fromAmazonRequest($requestHeaders, $requestBody);
        $this->assertInstanceOf(SessionEndedRequest::class, $request->request);
    }
}
