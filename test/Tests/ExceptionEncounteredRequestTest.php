<?php

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
        $requestHeaders = [
            'Signature'             => '',
            'SignatureCertChainUrl' => 'https://s3.amazonaws.com/echo.api/echo-api-cert.pem',
        ];
        $requestBody    = file_get_contents(__DIR__.'/RequestData/systemError.json');
        $request        = Request::fromAmazonRequest($requestHeaders, $requestBody);
        $this->assertInstanceOf(ExceptionEncounteredRequest::class, $request->request);
    }
}
