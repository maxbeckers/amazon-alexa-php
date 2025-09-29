<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Test\RequestHandler\Basic;

use MaxBeckers\AmazonAlexa\Helper\ResponseHelper;
use MaxBeckers\AmazonAlexa\Request\Request;
use MaxBeckers\AmazonAlexa\RequestHandler\Basic\StopRequestHandler;
use MaxBeckers\AmazonAlexa\Response\Response;
use MaxBeckers\AmazonAlexa\Response\ResponseBody;
use PHPUnit\Framework\TestCase;

class StopRequestHandlerTest extends TestCase
{
    public function testSupportsRequestAndOutput(): void
    {
        $responseHelper = $this->getMockBuilder(ResponseHelper::class)
                               ->disableOriginalConstructor()
                               ->getMock();

        $request = Request::fromAmazonRequest('{"request":{"type":"IntentRequest", "requestId":"requestId", "timestamp":"' . time() . '", "locale":"en-US", "intent":{"name":"AMAZON.StopIntent"}}}', 'true', 'true');
        $output = 'Just a simple Test';
        $requestHandler = new StopRequestHandler($responseHelper, $output, ['my_skill_id']);

        $responseBody = new ResponseBody();
        $responseBody->outputSpeech = $output;
        $responseHelper->expects(static::once())->method('respond')->willReturn(new Response([], '1.0', $responseBody));

        static::assertTrue($requestHandler->supportsRequest($request));
        static::assertSame($output, $requestHandler->handleRequest($request)->response->outputSpeech);
    }

    public function testNotSupportsRequest(): void
    {
        $request = Request::fromAmazonRequest('{"request":{"type":"IntentRequest", "requestId":"requestId", "timestamp":"' . time() . '", "locale":"en-US", "intent":{"name":"InvalidIntent"}}}', 'true', 'true');
        $output = 'Just a simple Test';
        $requestHandler = new StopRequestHandler(new ResponseHelper(), $output, ['my_skill_id']);

        static::assertFalse($requestHandler->supportsRequest($request));
    }
}
