<?php

namespace MaxBeckers\AmazonAlexa\Test\RequestHandler;

use MaxBeckers\AmazonAlexa\Exception\MissingRequestHandlerException;
use MaxBeckers\AmazonAlexa\Helper\ResponseHelper;
use MaxBeckers\AmazonAlexa\Request\Application;
use MaxBeckers\AmazonAlexa\Request\Context;
use MaxBeckers\AmazonAlexa\Request\Request;
use MaxBeckers\AmazonAlexa\Request\Request\Standard\IntentRequest;
use MaxBeckers\AmazonAlexa\Request\System;
use MaxBeckers\AmazonAlexa\RequestHandler\AbstractRequestHandler;
use MaxBeckers\AmazonAlexa\RequestHandler\RequestHandlerRegistry;
use MaxBeckers\AmazonAlexa\Response\Response;
use PHPUnit\Framework\TestCase;

/**
 * @author Maximilian Beckers <beckers.maximilian@gmail.com>
 */
class RequestHandlerRegistryTest extends TestCase
{
    public function testSimpleRequest()
    {
        $responseHelper = new ResponseHelper();
        $handler        = new SimpleTestRequestHandler($responseHelper);
        $registry       = new RequestHandlerRegistry();

        $intentRequest              = new IntentRequest();
        $intentRequest->type        = 'test';
        $application                = new Application();
        $application->applicationId = 'my_amazon_skill_id';
        $system                     = new System();
        $system->application        = $application;
        $context                    = new Context();
        $context->system            = $system;
        $request                    = new Request();
        $request->request           = $intentRequest;
        $request->context           = $context;

        $registry->addHandler($handler);
        $registry->getSupportingHandler($request);

        $this->assertSame($handler, $registry->getSupportingHandler($request));
    }

    public function testSimpleRequestAddHandlerByConstructor()
    {
        $responseHelper = new ResponseHelper();
        $handler        = new SimpleTestRequestHandler($responseHelper);
        $registry       = new RequestHandlerRegistry([$handler]);

        $intentRequest              = new IntentRequest();
        $intentRequest->type        = 'test';
        $application                = new Application();
        $application->applicationId = 'my_amazon_skill_id';
        $system                     = new System();
        $system->application        = $application;
        $context                    = new Context();
        $context->system            = $system;
        $request                    = new Request();
        $request->request           = $intentRequest;
        $request->context           = $context;

        $registry->getSupportingHandler($request);

        $this->assertSame($handler, $registry->getSupportingHandler($request));
    }

    public function testMissingHandlerRequest()
    {
        $registry = new RequestHandlerRegistry();

        $intentRequest              = new IntentRequest();
        $intentRequest->type        = 'test';
        $application                = new Application();
        $application->applicationId = 'my_amazon_skill_id';
        $system                     = new System();
        $system->application        = $application;
        $context                    = new Context();
        $context->system            = $system;
        $request                    = new Request();
        $request->request           = $intentRequest;
        $request->context           = $context;

        $this->expectException(MissingRequestHandlerException::class);
        $registry->getSupportingHandler($request);
    }
}

/**
 * Just a simple test example.
 *
 * @author Maximilian Beckers <beckers.maximilian@gmail.com>
 */
class SimpleTestRequestHandler extends AbstractRequestHandler
{
    /**
     * @var ResponseHelper
     */
    private $responseHelper;

    /**
     * @param ResponseHelper $responseHelper
     */
    public function __construct(ResponseHelper $responseHelper)
    {
        $this->responseHelper          = $responseHelper;
        $this->supportedApplicationIds = ['my_amazon_skill_id'];
    }

    /**
     * {@inheritdoc}
     */
    public function supportsRequest(Request $request): bool
    {
        // support test requests.
        return 'test' === $request->request->type;
    }

    /**
     * {@inheritdoc}
     */
    public function handleRequest(Request $request): Response
    {
        return $this->responseHelper->respond('Success :)');
    }
}
