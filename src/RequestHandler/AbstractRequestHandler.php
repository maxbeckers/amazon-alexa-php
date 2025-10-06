<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\RequestHandler;

use MaxBeckers\AmazonAlexa\Request\Request;
use MaxBeckers\AmazonAlexa\Response\Response;

abstract class AbstractRequestHandler
{
    /**
     * @param string[] $supportedApplicationIds Array of supported application IDs
     */
    public function __construct(
        protected array $supportedApplicationIds = [],
    ) {
    }

    public function supportsApplication(Request $request): bool
    {
        return in_array($request->getApplicationId(), $this->supportedApplicationIds, true);
    }

    abstract public function supportsRequest(Request $request): bool;

    abstract public function handleRequest(Request $request): ?Response;
}
