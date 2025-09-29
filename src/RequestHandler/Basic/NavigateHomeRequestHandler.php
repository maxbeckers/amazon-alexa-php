<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\RequestHandler\Basic;

use MaxBeckers\AmazonAlexa\Helper\ResponseHelper;
use MaxBeckers\AmazonAlexa\Request\Request;
use MaxBeckers\AmazonAlexa\Request\Request\Standard\IntentRequest;
use MaxBeckers\AmazonAlexa\RequestHandler\AbstractRequestHandler;
use MaxBeckers\AmazonAlexa\Response\Response;

class NavigateHomeRequestHandler extends AbstractRequestHandler
{
    public function __construct(
        private readonly ResponseHelper $responseHelper,
        private readonly string $output,
        array $supportedApplicationIds
    ) {
        $this->supportedApplicationIds = $supportedApplicationIds;
    }

    public function supportsRequest(Request $request): bool
    {
        // support amazon navigate home request, amazon default intents are prefixed with "AMAZON."
        return $request->request instanceof IntentRequest && 'AMAZON.NavigateHomeIntent' === $request->request->intent->name;
    }

    public function handleRequest(Request $request): Response
    {
        return $this->responseHelper->respond($this->output);
    }
}
