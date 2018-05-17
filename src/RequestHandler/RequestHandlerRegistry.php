<?php

namespace MaxBeckers\AmazonAlexa\RequestHandler;

use MaxBeckers\AmazonAlexa\Exception\MissingRequestHandlerException;
use MaxBeckers\AmazonAlexa\Request\Request;

/**
 * @author Maximilian Beckers <beckers.maximilian@gmail.com>
 */
class RequestHandlerRegistry
{
    /**
     * @var AbstractRequestHandler[]
     */
    private $requestHandlers = [];

    /**
     * @param AbstractRequestHandler[] $requestHandlers
     */
    public function __construct(array $requestHandlers = [])
    {
        $this->requestHandlers = $requestHandlers;
    }

    /**
     * @param Request $request
     *
     * @throws MissingRequestHandlerException
     *
     * @return AbstractRequestHandler
     */
    public function getSupportingHandler(Request $request): AbstractRequestHandler
    {
        foreach ($this->requestHandlers as $requestHandler) {
            if ($requestHandler->supportsApplication($request) && $requestHandler->supportsRequest($request)) {
                return $requestHandler;
            }
        }

        throw new MissingRequestHandlerException();
    }

    /**
     * @param AbstractRequestHandler $handler
     */
    public function addHandler(AbstractRequestHandler $handler)
    {
        $this->requestHandlers[] = $handler;
    }
}
