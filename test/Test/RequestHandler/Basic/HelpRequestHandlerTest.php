<?php

namespace MaxBeckers\AmazonAlexa\RequestHandler\Basic;

use MaxBeckers\AmazonAlexa\Helper\ResponseHelper;
use MaxBeckers\AmazonAlexa\Request\Request;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * @author Maximilian Beckers <beckers.maximilian@gmail.com>
 */
class HelpRequestHandlerTest extends TestCase
{
    /**
     * @var MockObject|ResponseHelper
     */
    private $responseHelper;

    public function setUp()
    {
        $this->responseHelper = static::getMockBuilder(ResponseHelper::class)
                                      ->disableOriginalConstructor()
                                      ->getMock();
    }

    public function testSupportsRequestAndOutput()
    {
        $request        = Request::fromAmazonRequest('{"type": "AMAZON.HelpIntent"}', '', '');
        $output         = 'Just a simple Test';
        $requestHandler = new HelpRequestHandler($this->responseHelper, $output, ['my_skill_id']);

        $this->responseHelper->expects(static::once())->method('respond')->willReturn($output);

        static::assertTrue($requestHandler->supportsRequest($request));
        static::assertSame($output, $requestHandler->handleRequest($request));
    }

    public function testNotSupportsRequest()
    {
        $request        = Request::fromAmazonRequest('{"type": "AMAZON.InvalidIntent"}', '', '');
        $output         = 'Just a simple Test';
        $requestHandler = new HelpRequestHandler($this->responseHelper, $output, ['my_skill_id']);

        static::assertFalse($requestHandler->supportsRequest($request));
    }
}
