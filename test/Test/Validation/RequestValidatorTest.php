<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Test\Validation;

use GuzzleHttp\Client;
use MaxBeckers\AmazonAlexa\Exception\RequestInvalidSignatureException;
use MaxBeckers\AmazonAlexa\Exception\RequestInvalidTimestampException;
use MaxBeckers\AmazonAlexa\Request\Request;
use MaxBeckers\AmazonAlexa\Request\Request\Standard\IntentRequest;
use MaxBeckers\AmazonAlexa\Validation\RequestValidator;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

class RequestValidatorTest extends TestCase
{
    public function testInvalidRequestTime(): void
    {
        $requestValidator = new RequestValidator();

        $intentRequest = new IntentRequest();
        $intentRequest->type = 'test';
        $intentRequest->timestamp = new \DateTime('-1 hour');
        $request = new Request();
        $request->request = $intentRequest;

        $this->expectException(RequestInvalidTimestampException::class);
        $requestValidator->validate($request);
    }

    public function testInvalidSignatureCertChainUrl(): void
    {
        $requestValidator = new RequestValidator();

        $intentRequest = new IntentRequest();
        $intentRequest->type = 'test';
        $intentRequest->timestamp = new \DateTime();
        $request = new Request();
        $request->request = $intentRequest;
        $request->signatureCertChainUrl = 'wrong path';
        $request->signature = 'none';

        $this->expectException(RequestInvalidSignatureException::class);
        $requestValidator->validate($request);
    }

    public function testWrongSignatureCertChainUrl(): void
    {
        $client = $this->createMock(Client::class);
        $apiResponse = $this->createMock(ResponseInterface::class);
        $apiResponseBody = $this->createMock(StreamInterface::class);
        $requestValidator = new RequestValidator(RequestValidator::TIMESTAMP_VALID_TOLERANCE_SECONDS, $client);

        $client->method('request')
               ->willReturn($apiResponse);
        $apiResponse->method('getStatusCode')
                    ->willReturn(200);
        $apiResponse->method('getBody')
                    ->willReturn($apiResponseBody);
        $apiResponseBody->method('getContents')
                        ->willReturn('cert content');

        $intentRequest = new IntentRequest();
        $intentRequest->type = 'test';
        $intentRequest->timestamp = new \DateTime();
        $request = new Request();
        $request->request = $intentRequest;
        $request->signatureCertChainUrl = 'https://s3.amazonaws.com/echo.api/test.pem';
        $request->signature = 'none';
        $request->amazonRequestBody = '';

        $this->expectException(RequestInvalidSignatureException::class);
        $requestValidator->validate($request);
    }

    public function testWrongSignatureCertChainUrlCallError(): void
    {
        $client = $this->createMock(Client::class);
        $apiResponse = $this->createMock(ResponseInterface::class);
        $requestValidator = new RequestValidator(RequestValidator::TIMESTAMP_VALID_TOLERANCE_SECONDS, $client);

        $client->method('request')
               ->willReturn($apiResponse);
        $apiResponse->method('getStatusCode')
                    ->willReturn(400);

        $intentRequest = new IntentRequest();
        $intentRequest->type = 'test';
        $intentRequest->timestamp = new \DateTime();
        $request = new Request();
        $request->request = $intentRequest;
        $request->signatureCertChainUrl = 'https://s3.amazonaws.com/echo.api/test.pem';
        $request->signature = 'none';
        $request->amazonRequestBody = '';

        $this->expectException(RequestInvalidSignatureException::class);
        $requestValidator->validate($request);
    }
}
