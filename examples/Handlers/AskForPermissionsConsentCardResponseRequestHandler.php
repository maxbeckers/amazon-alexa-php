<?php

declare(strict_types=1);

use MaxBeckers\AmazonAlexa\Helper\ResponseHelper;
use MaxBeckers\AmazonAlexa\Request\Request;
use MaxBeckers\AmazonAlexa\Request\Request\Standard\IntentRequest;
use MaxBeckers\AmazonAlexa\RequestHandler\AbstractRequestHandler;
use MaxBeckers\AmazonAlexa\Response\Card;
use MaxBeckers\AmazonAlexa\Response\Response;

/**
 * Just a example request handler for a card response with ask for permissions.
 */
class AskForPermissionsConsentCardResponseRequestHandler extends AbstractRequestHandler
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
        // here for example try to get full address. DeviceAddressInformationHelper->getAddress($request)
        // when you get a 403 do sth. like the following.

        // create a card to ask the user for full address permissions
        $card = Card::createAskForPermissionsConsent([Card::PERMISSION_FULL_ADDRESS]);
        $this->responseHelper->card($card);

        return $this->responseHelper->getResponse();
    }
}
