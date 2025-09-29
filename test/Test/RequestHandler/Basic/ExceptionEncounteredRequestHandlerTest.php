<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Test\RequestHandler\Basic;

use MaxBeckers\AmazonAlexa\Helper\ResponseHelper;
use MaxBeckers\AmazonAlexa\Request\Request;
use MaxBeckers\AmazonAlexa\RequestHandler\Basic\ExceptionEncounteredRequestHandler;
use MaxBeckers\AmazonAlexa\Response\Response;
use MaxBeckers\AmazonAlexa\Response\ResponseBody;
use PHPUnit\Framework\TestCase;

class ExceptionEncounteredRequestHandlerTest extends TestCase
{
    public function testSupportsRequestAndOutput(): void
    {
        $responseHelper = $this->getMockBuilder(ResponseHelper::class)
                               ->disableOriginalConstructor()
                               ->getMock();

        $request = Request::fromAmazonRequest('{"request":{"type":"System.ExceptionEncountered", "requestId":"requestId", "timestamp":"' . time() . '", "locale":"en-US"}}', 'true', 'true');
        $output = 'Just a simple Test';
        $requestHandler = new ExceptionEncounteredRequestHandler($responseHelper, $output, ['my_skill_id']);

        $responseBody = new ResponseBody();
        $responseBody->outputSpeech = $output;
        $responseHelper->expects(static::once())->method('respond')->willReturn(new Response([], '1.0', $responseBody));

        static::assertTrue($requestHandler->supportsRequest($request));
        static::assertSame($output, $requestHandler->handleRequest($request)->response->outputSpeech);
    }

    public function testNotSupportsRequest(): void
    {
        $request = Request::fromAmazonRequest('{"request":{"type":"IntentRequest", "intent":{"name":"InvalidIntent"}, "requestId":"requestId", "timestamp":"' . time() . '", "locale":"en-US"}}', 'true', 'true');
        $output = 'Just a simple Test';
        $requestHandler = new ExceptionEncounteredRequestHandler(new ResponseHelper(), $output, ['my_skill_id']);

        static::assertFalse($requestHandler->supportsRequest($request));
    }
}
