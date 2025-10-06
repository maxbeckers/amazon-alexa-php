<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Test\Request;

use MaxBeckers\AmazonAlexa\Request\Request;
use MaxBeckers\AmazonAlexa\Request\Request\APL\LoadIndexListDataRequest;
use MaxBeckers\AmazonAlexa\Request\Request\APL\LoadTokenListDataRequest;
use MaxBeckers\AmazonAlexa\Request\Request\APL\RuntimeError;
use MaxBeckers\AmazonAlexa\Request\Request\APL\RuntimeErrorRequest;
use MaxBeckers\AmazonAlexa\Request\Request\APL\RuntimeErrorType;
use MaxBeckers\AmazonAlexa\Request\Request\APL\UserEventRequest;
use PHPUnit\Framework\TestCase;

class APLRequestsTest extends TestCase
{
    public function testLoadIndexListDataRequest(): void
    {
        $requestBody = file_get_contents(__DIR__ . '/RequestData/aplLoadIndexListData.json');
        $request = Request::fromAmazonRequest($requestBody, 'https://s3.amazonaws.com/echo.api/echo-api-cert.pem', 'signature');

        $this->assertInstanceOf(LoadIndexListDataRequest::class, $request->request);
        $this->assertEquals('Alexa.Presentation.APL.LoadIndexListData', $request->request->type);
        $this->assertEquals('developer-provided-token', $request->request->token);
        $this->assertEquals('101', $request->request->correlationToken);
        $this->assertEquals('my-list-id', $request->request->listId);
        $this->assertEquals('10', $request->request->startIndex);
        $this->assertEquals(5, $request->request->count);
    }

    public function testLoadTokenListDataRequest(): void
    {
        $requestBody = file_get_contents(__DIR__ . '/RequestData/aplLoadTokenListData.json');
        $request = Request::fromAmazonRequest($requestBody, 'https://s3.amazonaws.com/echo.api/echo-api-cert.pem', 'signature');

        $this->assertInstanceOf(LoadTokenListDataRequest::class, $request->request);
        $this->assertEquals('Alexa.Presentation.APL.LoadTokenListData', $request->request->type);
        $this->assertEquals('developer-provided-token', $request->request->token);
        $this->assertEquals('101', $request->request->correlationToken);
        $this->assertEquals('my-list-id', $request->request->listId);
        $this->assertEquals('myListPage2', $request->request->pageToken);
    }

    public function testRuntimeErrorRequest(): void
    {
        $requestBody = file_get_contents(__DIR__ . '/RequestData/aplRuntimeError.json');
        $request = Request::fromAmazonRequest($requestBody, 'https://s3.amazonaws.com/echo.api/echo-api-cert.pem', 'signature');

        $this->assertInstanceOf(RuntimeErrorRequest::class, $request->request);
        $this->assertEquals('Alexa.Presentation.APL.RuntimeError', $request->request->type);
        $this->assertEquals('developer-provided-token', $request->request->token);
        $this->assertCount(1, $request->request->errors);

        $error = $request->request->errors[0];
        $this->assertInstanceOf(RuntimeError::class, $error);
        $this->assertEquals(RuntimeErrorType::LIST_ERROR, $error->type);
        $this->assertEquals('LIST_INDEX_OUT_OF_RANGE', $error->reason);
        $this->assertEquals('my-list-id', $error->listId);
        $this->assertEquals(3, $error->listVersion);
        $this->assertEquals(3, $error->operationIndex);
        $this->assertEquals('Index out of range error', $error->message);
    }

    public function testUserEventRequest(): void
    {
        $requestBody = file_get_contents(__DIR__ . '/RequestData/aplUserEvent.json');
        $request = Request::fromAmazonRequest($requestBody, 'https://s3.amazonaws.com/echo.api/echo-api-cert.pem', 'signature');

        $this->assertInstanceOf(UserEventRequest::class, $request->request);
        $this->assertEquals('Alexa.Presentation.APL.UserEvent', $request->request->type);
        $this->assertEquals('developer-provided-token', $request->request->token);
        $this->assertCount(1, $request->request->arguments);
        $this->assertEquals('ItemIDForSmokedWildSalmon', $request->request->arguments[0]['itemId']);
        $this->assertEquals('TouchWrapper', $request->request->source['type']);
        $this->assertEquals('Press', $request->request->source['handler']);
        $this->assertEquals('myTouchWrapperPress', $request->request->source['id']);
        $this->assertEquals('TouchWrapper', $request->request->components['myTouchWrapperPress']['type']);
        $this->assertEquals('widget-presentation-uri-123', $request->request->presentationUri);
    }

    public function testLoadIndexListDataRequestWithNumericStartIndex(): void
    {
        $requestBody = json_decode(file_get_contents(__DIR__ . '/RequestData/aplLoadIndexListData.json'), true);
        $requestBody['request']['startIndex'] = 10;
        $requestBody = json_encode($requestBody);

        $request = Request::fromAmazonRequest($requestBody, 'https://s3.amazonaws.com/echo.api/echo-api-cert.pem', 'signature');

        $this->assertInstanceOf(LoadIndexListDataRequest::class, $request->request);
        $this->assertEquals(10, $request->request->startIndex);
    }

    public function testRuntimeErrorRequestValidateTimestamp(): void
    {
        $requestBody = file_get_contents(__DIR__ . '/RequestData/aplRuntimeError.json');
        $request = Request::fromAmazonRequest($requestBody, 'https://s3.amazonaws.com/echo.api/echo-api-cert.pem', 'signature');

        $this->assertInstanceOf(RuntimeErrorRequest::class, $request->request);
        $this->assertFalse($request->request->validateTimestamp());
    }

    public function testUserEventRequestValidateTimestamp(): void
    {
        $requestBody = file_get_contents(__DIR__ . '/RequestData/aplUserEvent.json');
        $request = Request::fromAmazonRequest($requestBody, 'https://s3.amazonaws.com/echo.api/echo-api-cert.pem', 'signature');

        $this->assertInstanceOf(UserEventRequest::class, $request->request);
        $this->assertFalse($request->request->validateTimestamp());
    }
}
