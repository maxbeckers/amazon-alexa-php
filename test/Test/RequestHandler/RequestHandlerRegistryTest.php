<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Test\RequestHandler;

use MaxBeckers\AmazonAlexa\Exception\MissingRequestHandlerException;
use MaxBeckers\AmazonAlexa\Helper\ResponseHelper;
use MaxBeckers\AmazonAlexa\Request\Application;
use MaxBeckers\AmazonAlexa\Request\Context;
use MaxBeckers\AmazonAlexa\Request\Request;
use MaxBeckers\AmazonAlexa\Request\Request\Standard\IntentRequest;
use MaxBeckers\AmazonAlexa\Request\Session;
use MaxBeckers\AmazonAlexa\Request\System;
use MaxBeckers\AmazonAlexa\RequestHandler\AbstractRequestHandler;
use MaxBeckers\AmazonAlexa\RequestHandler\RequestHandlerRegistry;
use MaxBeckers\AmazonAlexa\Response\Response;
use PHPUnit\Framework\TestCase;

class RequestHandlerRegistryTest extends TestCase
{
    public function testSimpleRequest(): void
    {
        $responseHelper = new ResponseHelper();
        $handler = new SimpleTestRequestHandler($responseHelper);
        $registry = new RequestHandlerRegistry();

        $intentRequest = new IntentRequest();
        $intentRequest->type = 'test';
        $application = new Application();
        $application->applicationId = 'my_amazon_skill_id';
        $system = new System();
        $system->application = $application;
        $context = new Context();
        $context->system = $system;
        $session = new Session();
        $session->application = $application;
        $request = new Request();
        $request->request = $intentRequest;
        $request->context = $context;
        $request->session = $session;

        $registry->addHandler($handler);
        $registry->getSupportingHandler($request);

        $this->assertSame($handler, $registry->getSupportingHandler($request));
    }

    public function testSimpleRequestAddHandlerByConstructor(): void
    {
        $responseHelper = new ResponseHelper();
        $handler = new SimpleTestRequestHandler($responseHelper);
        $registry = new RequestHandlerRegistry([$handler]);

        $intentRequest = new IntentRequest();
        $intentRequest->type = 'test';
        $application = new Application();
        $application->applicationId = 'my_amazon_skill_id';
        $system = new System();
        $system->application = $application;
        $context = new Context();
        $context->system = $system;
        $session = new Session();
        $session->application = $application;
        $request = new Request();
        $request->request = $intentRequest;
        $request->context = $context;
        $request->session = $session;

        $registry->getSupportingHandler($request);

        $this->assertSame($handler, $registry->getSupportingHandler($request));
    }

    public function testMissingHandlerRequest(): void
    {
        $registry = new RequestHandlerRegistry();

        $intentRequest = new IntentRequest();
        $intentRequest->type = 'test';
        $application = new Application();
        $application->applicationId = 'my_amazon_skill_id';
        $system = new System();
        $system->application = $application;
        $context = new Context();
        $context->system = $system;
        $session = new Session();
        $session->application = $application;
        $request = new Request();
        $request->request = $intentRequest;
        $request->context = $context;
        $request->session = $session;

        $this->expectException(MissingRequestHandlerException::class);
        $registry->getSupportingHandler($request);
    }
}
class SimpleTestRequestHandler extends AbstractRequestHandler
{
    public function __construct(
        private readonly ResponseHelper $responseHelper
    ) {
        $this->supportedApplicationIds = ['my_amazon_skill_id'];
    }

    public function supportsRequest(Request $request): bool
    {
        return 'test' === $request->request->type;
    }

    public function handleRequest(Request $request): Response
    {
        return $this->responseHelper->respond('Success :)');
    }
}
