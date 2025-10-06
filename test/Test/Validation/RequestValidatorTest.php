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

    public function testValidTimestampWithinTolerance(): void
    {
        $validator = new RequestValidator();
        $intent = new IntentRequest();
        $intent->timestamp = new \DateTime('-10 seconds');
        $intent->type = 'test';
        $r = new Request();
        $r->request = $intent;
        $r->signatureCertChainUrl = 'https://s3.amazonaws.com/echo.api/echo-api-cert.pem';
        $r->signature = 'SGVsbG8='; // base64 "Hello"

        // validateSignature will fail (no real cert), so disable signature path by overriding property
        $intentWithNoSignature = new class ($intent) extends IntentRequest {
            public function __construct(IntentRequest $base)
            {
                $this->timestamp = $base->timestamp;
                $this->type = $base->type;
            }
            public function validateSignature(): bool
            {
                return false;
            }
        };
        $r->request = $intentWithNoSignature;

        $validator->validate($r);
        $this->assertTrue(true);
    }

    public function testTimestampExactlyOnToleranceBoundaryPasses(): void
    {
        $tolerance = 50;
        $validator = new RequestValidator($tolerance);
        $intent = new IntentRequest();
        $intent->timestamp = new \DateTime("-{$tolerance} seconds");
        $intent->type = 'test';
        $r = new Request();
        $r->request = $intent;
        $intent = new class ($intent) extends IntentRequest {
            public function __construct(IntentRequest $base)
            {
                $this->timestamp = $base->timestamp;
                $this->type = $base->type;
            }
            public function validateSignature(): bool
            {
                return false;
            }
        };
        $r->request = $intent;

        $validator->validate($r);
        $this->assertTrue(true);
    }

    public function testTimestampJustOverToleranceFails(): void
    {
        $tolerance = 30;
        $validator = new RequestValidator($tolerance);
        $intent = new IntentRequest();
        $intent->timestamp = new \DateTime('-' . ($tolerance + 1) . ' seconds');
        $intent->type = 'test';
        $r = new Request();
        $r->request = $intent;

        $this->expectException(RequestInvalidTimestampException::class);
        $validator->validate($r);
    }

    public function testSkipTimestampValidationWhenRequestDisablesIt(): void
    {
        $validator = new RequestValidator();
        $intent = new class () extends IntentRequest {
            public function __construct()
            {
                $this->timestamp = new \DateTime('-5 hours'); // would normally fail
                $this->type = 'test';
            }
            public function validateTimestamp(): bool
            {
                return false;
            }
            public function validateSignature(): bool
            {
                return false;
            }
        };
        $r = new Request();
        $r->request = $intent;

        $validator->validate($r);
        $this->assertTrue(true);
    }

    public function testSkipSignatureValidationWhenRequestDisablesIt(): void
    {
        $client = $this->createMock(Client::class);
        $client->expects($this->never())->method('request');

        $validator = new RequestValidator(RequestValidator::TIMESTAMP_VALID_TOLERANCE_SECONDS, $client);

        $intent = new class () extends IntentRequest {
            public function __construct()
            {
                $this->timestamp = new \DateTime();
                $this->type = 'test';
            }
            public function validateSignature(): bool
            {
                return false;
            }
        };

        $r = new Request();
        $r->request = $intent;
        $r->signatureCertChainUrl = 'https://s3.amazonaws.com/echo.api/echo-api-cert.pem';
        $r->signature = 'AA==';
        $validator->validate($r);

        $this->assertTrue(true);
    }

    public function testSignatureValidationPerformsHttpRequest(): void
    {
        $client = $this->createMock(Client::class);
        $response = $this->createMock(ResponseInterface::class);
        $stream = $this->createMock(StreamInterface::class);

        // Use a unique URL to avoid cached certificates
        $uniqueUrl = 'https://s3.amazonaws.com/echo.api/echo-api-cert-' . uniqid() . '.pem';
        $localPath = sys_get_temp_dir() . DIRECTORY_SEPARATOR . md5($uniqueUrl) . '.pem';

        // Ensure no cached certificate exists
        @unlink($localPath);

        $client->expects($this->once())->method('request')->with('GET', $uniqueUrl)->willReturn($response);
        $response->method('getStatusCode')->willReturn(200);
        $response->method('getBody')->willReturn($stream);
        $stream->method('getContents')->willReturn("-----BEGIN CERTIFICATE-----\nFAKE\n-----END CERTIFICATE-----");

        $validator = new RequestValidator(RequestValidator::TIMESTAMP_VALID_TOLERANCE_SECONDS, $client);

        $intent = new class () extends IntentRequest {
            public function __construct()
            {
                $this->timestamp = new \DateTime();
                $this->type = 'test';
            }
            public function validateSignature(): bool
            {
                return true; // Enable signature validation to trigger HTTP request
            }
        };

        $r = new Request();
        $r->request = $intent;
        $r->amazonRequestBody = 'BODY';
        $r->signature = base64_encode('sig');
        $r->signatureCertChainUrl = $uniqueUrl;

        $this->expectException(RequestInvalidSignatureException::class);
        $validator->validate($r);
    }

    public function testSignatureValidationUsesCachedCertWithoutHttpCall(): void
    {
        $url = 'https://s3.amazonaws.com/echo.api/cached-cert.pem';
        $localPath = sys_get_temp_dir() . DIRECTORY_SEPARATOR . md5($url) . '.pem';
        file_put_contents($localPath, "-----BEGIN CERTIFICATE-----\nCACHED\n-----END CERTIFICATE-----");

        $client = $this->createMock(Client::class);
        $client->expects($this->never())->method('request');

        $validator = new RequestValidator(RequestValidator::TIMESTAMP_VALID_TOLERANCE_SECONDS, $client);

        $intent = new class () extends IntentRequest {
            public function __construct()
            {
                $this->timestamp = new \DateTime();
                $this->type = 'test';
            }
            public function validateSignature(): bool
            {
                return true;
            }
        };

        $r = new Request();
        $r->request = $intent;
        $r->amazonRequestBody = 'BODY';
        $r->signature = base64_encode('sig');
        $r->signatureCertChainUrl = $url;

        $this->expectException(RequestInvalidSignatureException::class);
        try {
            $validator->validate($r);
        } finally {
            @unlink($localPath);
        }
    }
}
