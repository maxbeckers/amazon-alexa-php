<?php

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
        $requestBody    = file_get_contents(__DIR__.'/RequestData/sessionEnded.json');
        $request        = Request::fromAmazonRequest($requestBody, 'https://s3.amazonaws.com/echo.api/echo-api-cert.pem', 'signature');
        $this->assertInstanceOf(SessionEndedRequest::class, $request->request);
    }
}
