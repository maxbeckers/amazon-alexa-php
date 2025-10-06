<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\RequestHandler\Basic;

use MaxBeckers\AmazonAlexa\Helper\ResponseHelper;
use MaxBeckers\AmazonAlexa\Request\Request;
use MaxBeckers\AmazonAlexa\Request\Request\System\ExceptionEncounteredRequest;
use MaxBeckers\AmazonAlexa\RequestHandler\AbstractRequestHandler;
use MaxBeckers\AmazonAlexa\Response\Response;

class ExceptionEncounteredRequestHandler extends AbstractRequestHandler
{
    public function __construct(
        private readonly ResponseHelper $responseHelper,
        private readonly string $output,
        array $supportedApplicationIds
    ) {
        parent::__construct();
        $this->supportedApplicationIds = $supportedApplicationIds;
    }

    public function supportsRequest(Request $request): bool
    {
        return $request->request instanceof ExceptionEncounteredRequest;
    }

    public function handleRequest(Request $request): Response
    {
        return $this->responseHelper->respond($this->output, true);
    }
}
