<?php

namespace MaxBeckers\AmazonAlexa\RequestHandler\Basic;

use MaxBeckers\AmazonAlexa\Helper\ResponseHelper;
use MaxBeckers\AmazonAlexa\Request\Request;
use MaxBeckers\AmazonAlexa\Request\Request\System\ExceptionEncounteredRequest;
use MaxBeckers\AmazonAlexa\RequestHandler\AbstractRequestHandler;
use MaxBeckers\AmazonAlexa\Response\Response;

/**
 * @author Maximilian Beckers <beckers.maximilian@gmail.com>
 */
class ExceptionEncounteredRequestHandler extends AbstractRequestHandler
{
    /**
     * @var ResponseHelper
     */
    private $responseHelper;

    /**
     * @var string
     */
    private $output;

    /**
     * @param ResponseHelper $responseHelper
     * @param string         $output
     * @param array          $supportedApplicationIds
     */
    public function __construct(ResponseHelper $responseHelper, string $output, array $supportedApplicationIds)
    {
        $this->responseHelper          = $responseHelper;
        $this->output                  = $output;
        $this->supportedApplicationIds = $supportedApplicationIds;
    }

    /**
     * @inheritdoc
     */
    public function supportsRequest(Request $request): bool
    {
        return $request->request instanceof ExceptionEncounteredRequest;
    }

    /**
     * @inheritdoc
     */
    public function handleRequest(Request $request): Response
    {
        return $this->responseHelper->respond($this->output, true);
    }
}
