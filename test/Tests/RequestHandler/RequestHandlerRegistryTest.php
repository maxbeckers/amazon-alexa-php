<?php

use MaxBeckers\AmazonAlexa\Exception\MissingRequestHandlerException;
use MaxBeckers\AmazonAlexa\Helper\ResponseHelper;
use MaxBeckers\AmazonAlexa\Request\Application;
use MaxBeckers\AmazonAlexa\Request\Request;
use MaxBeckers\AmazonAlexa\Request\Request\Standard\IntentRequest;
use MaxBeckers\AmazonAlexa\Request\Session;
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
        $handler        = new SimpleRequestHandler($responseHelper);
        $registry       = new RequestHandlerRegistry();

        $intentRequest              = new IntentRequest();
        $intentRequest->type        = 'test';
        $application                = new Application();
        $application->applicationId = 'my_amazon_skill_id';
        $session                    = new Session();
        $session->application       = $application;
        $request                    = new Request();
        $request->request           = $intentRequest;
        $request->session           = $session;

        $registry->addHandler($handler);
        $registry->getSupportingHandler($request);

        $this->assertEquals($handler, $registry->getSupportingHandler($request));
    }

    public function testMissingHandlerRequest()
    {
        $registry       = new RequestHandlerRegistry();

        $intentRequest              = new IntentRequest();
        $intentRequest->type        = 'test';
        $application                = new Application();
        $application->applicationId = 'my_amazon_skill_id';
        $session                    = new Session();
        $session->application       = $application;
        $request                    = new Request();
        $request->request           = $intentRequest;
        $request->session           = $session;

        $this->expectException(MissingRequestHandlerException::class);
        $registry->getSupportingHandler($request);
    }
}


/**
 * Just a simple test example
 *
 * @author Maximilian Beckers <beckers.maximilian@gmail.com>
 */
class SimpleRequestHandler extends AbstractRequestHandler
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