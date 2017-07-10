<?php

use MaxBeckers\AmazonAlexa\Helper\ResponseHelper;
use MaxBeckers\AmazonAlexa\Request\Request;
use MaxBeckers\AmazonAlexa\RequestHandler\AbstractRequestHandler;
use MaxBeckers\AmazonAlexa\RequestHandler\RequestHandlerRegistry;
use MaxBeckers\AmazonAlexa\Response\Response;
use MaxBeckers\AmazonAlexa\Validation\RequestValidator;

require '../vendor/autoload.php';

$requestBody = file_get_contents('php://input');
if ($requestBody) {
    $alexaRequest = Request::fromAmazonRequest(getallheaders(), $requestBody);

    // Request validation
    $validator = new RequestValidator();
    $validator->validate($alexaRequest);

    // add handlers to registry
    $responseHelper         = new ResponseHelper();
    $mySimpleRequestHandler = new SimpleRequestHandler($responseHelper);
    $requestHandlerRegistry = new RequestHandlerRegistry();
    $requestHandlerRegistry->addHandler($mySimpleRequestHandler);

    // handle request
    $requestHandler = $requestHandlerRegistry->getSupportingHandler($alexaRequest);
    $response       = $requestHandler->handleRequest($alexaRequest);

    // render response
    header('Content-Type: application/json');
    echo json_encode($response);
}

exit();

/**
 * Just a simple example
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
        // support all requests, should not be done.
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function handleRequest(Request $request): Response
    {
        return $this->responseHelper->respond('Success :)');
    }
}
