<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Test\RequestHandler\Basic;

use MaxBeckers\AmazonAlexa\Helper\ResponseHelper;
use MaxBeckers\AmazonAlexa\Request\Request;
use MaxBeckers\AmazonAlexa\RequestHandler\Basic\HelpRequestHandler;
use MaxBeckers\AmazonAlexa\Response\Response;
use MaxBeckers\AmazonAlexa\Response\ResponseBody;
use PHPUnit\Framework\TestCase;

class HelpRequestHandlerTest extends TestCase
{
    public function testSupportsRequestAndOutput(): void
    {
        $responseHelper = $this->getMockBuilder(ResponseHelper::class)
                               ->disableOriginalConstructor()
                               ->getMock();

        $request = Request::fromAmazonRequest('{"request":{"type":"IntentRequest", "requestId":"requestId", "timestamp":"' . time() . '", "locale":"en-US", "intent":{"name":"AMAZON.HelpIntent"}}}', 'true', 'true');
        $output = 'Just a simple Test';
        $requestHandler = new HelpRequestHandler($responseHelper, $output, ['my_skill_id']);

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
        $requestHandler = new HelpRequestHandler(new ResponseHelper(), $output, ['my_skill_id']);

        static::assertFalse($requestHandler->supportsRequest($request));
    }
}
