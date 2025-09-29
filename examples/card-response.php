<?php

declare(strict_types=1);

use MaxBeckers\AmazonAlexa\Helper\ResponseHelper;
use MaxBeckers\AmazonAlexa\Request\Request;
use MaxBeckers\AmazonAlexa\RequestHandler\Basic\HelpRequestHandler;
use MaxBeckers\AmazonAlexa\RequestHandler\RequestHandlerRegistry;
use MaxBeckers\AmazonAlexa\Validation\RequestValidator;

require '../vendor/autoload.php';
require 'Handlers/CardResponseRequestHandler.php';

/**
 * Simple example for request handling workflow with card response and help example
 * loading json
 * creating request
 * validating request
 * adding request handler to registry
 * handling request
 * returning json response
 */
$requestBody = file_get_contents('php://input');
if ($requestBody) {
    $alexaRequest = Request::fromAmazonRequest($requestBody, $_SERVER['HTTP_SIGNATURECERTCHAINURL'], $_SERVER['HTTP_SIGNATURE']);

    if (!$alexaRequest) {
        http_response_code(400);
        exit();
    }

    // Request validation
    $validator = new RequestValidator();
    $validator->validate($alexaRequest);

    // add handlers to registry
    $responseHelper = new ResponseHelper();
    $helpRequestHandler = new HelpRequestHandler($responseHelper, 'Help Text', ['my_amazon_skill_id']);
    $mySimpleRequestHandler = new CardResponseRequestHandler($responseHelper);
    $requestHandlerRegistry = new RequestHandlerRegistry([$helpRequestHandler, $mySimpleRequestHandler]);

    // handle request
    $requestHandler = $requestHandlerRegistry->getSupportingHandler($alexaRequest);
    $response = $requestHandler->handleRequest($alexaRequest);

    // render response
    header('Content-Type: application/json');
    echo json_encode($response);
} else {
    http_response_code(400);
}

exit();
