<?php

declare(strict_types=1);

use MaxBeckers\AmazonAlexa\Helper\ResponseHelper;
use MaxBeckers\AmazonAlexa\Request\Request;
use MaxBeckers\AmazonAlexa\Request\Request\Standard\IntentRequest;
use MaxBeckers\AmazonAlexa\RequestHandler\AbstractRequestHandler;
use MaxBeckers\AmazonAlexa\Response\Response;

/**
 * Just a simple example request handler.
 */
class SimpleIntentRequestHandler extends AbstractRequestHandler
{
    public function __construct(
        private readonly ResponseHelper $responseHelper
    ) {
        parent::__construct();
        $this->supportedApplicationIds = ['my_amazon_skill_id'];
    }

    public function supportsRequest(Request $request): bool
    {
        // support all intent requests, should not be done.
        return $request->request instanceof IntentRequest;
    }

    public function handleRequest(Request $request): Response
    {
        return $this->responseHelper->respond('Success :)');
    }
}