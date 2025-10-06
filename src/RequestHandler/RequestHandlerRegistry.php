<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\RequestHandler;

use MaxBeckers\AmazonAlexa\Exception\MissingRequestHandlerException;
use MaxBeckers\AmazonAlexa\Request\Request;

class RequestHandlerRegistry
{
    /**
     * @param AbstractRequestHandler[] $requestHandlers Array of request handlers
     */
    public function __construct(
        private array $requestHandlers = [],
    ) {
    }

    public function getSupportingHandler(Request $request): AbstractRequestHandler
    {
        foreach ($this->requestHandlers as $requestHandler) {
            if ($requestHandler->supportsApplication($request) && $requestHandler->supportsRequest($request)) {
                return $requestHandler;
            }
        }

        throw new MissingRequestHandlerException();
    }

    public function addHandler(AbstractRequestHandler $handler): void
    {
        $this->requestHandlers[] = $handler;
    }
}
