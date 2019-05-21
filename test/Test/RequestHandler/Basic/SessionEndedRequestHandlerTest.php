<?php

namespace MaxBeckers\AmazonAlexa\RequestHandler\Basic;

use MaxBeckers\AmazonAlexa\Helper\ResponseHelper;
use MaxBeckers\AmazonAlexa\Request\Request;
use MaxBeckers\AmazonAlexa\Response\Response;
use MaxBeckers\AmazonAlexa\Response\ResponseBody;
use PHPUnit\Framework\TestCase;

/**
 * @author Maximilian Beckers <beckers.maximilian@gmail.com>
 */
class SessionEndedRequestHandlerTest extends TestCase
{
    public function testSupportsRequestAndOutput()
    {
        $responseHelper = $this->getMockBuilder(ResponseHelper::class)
                               ->disableOriginalConstructor()
                               ->getMock();

        $request        = Request::fromAmazonRequest('{"request":{"type":"SessionEndedRequest"}}', 'true', 'true');
        $output         = 'Just a simple Test';
        $requestHandler = new SessionEndedRequestHandler($responseHelper, $output, ['my_skill_id']);

        $responseBody               = new ResponseBody();
        $responseBody->outputSpeech = $output;
        $responseHelper->expects(static::once())->method('respond')->willReturn(new Response([], '1.0', $responseBody));

        static::assertTrue($requestHandler->supportsRequest($request));
        static::assertSame($output, $requestHandler->handleRequest($request)->response->outputSpeech);
    }

    public function testNotSupportsRequest()
    {
        $request        = Request::fromAmazonRequest('{"request":{"type":"IntentRequest", "intent":{"name":"InvalidIntent"}}}', 'true', 'true');
        $output         = 'Just a simple Test';
        $requestHandler = new SessionEndedRequestHandler(new ResponseHelper(), $output, ['my_skill_id']);

        static::assertFalse($requestHandler->supportsRequest($request));
    }
}
