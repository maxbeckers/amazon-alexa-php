<?php

namespace MaxBeckers\AmazonAlexa\RequestHandler;

use MaxBeckers\AmazonAlexa\Request\Request;
use MaxBeckers\AmazonAlexa\Response\Response;

/**
 * @author Maximilian Beckers <beckers.maximilian@gmail.com>
 */
abstract class AbstractRequestHandler
{
    /**
     * @var array
     */
    protected $supportedApplicationIds = [];

    /**
     * Check if the request handler can handle given request from skill.
     *
     * @param Request $request
     *
     * @return bool
     */
    public function supportsApplication(Request $request): bool
    {
        return in_array($request->getApplicationId(), $this->supportedApplicationIds, true);
    }

    /**
     * Check if the request handler can handle given request.
     * For example:
     * Request type is an intent request and your skill uses the AMAZON.HelpIntent and the AMAZON.StopIntent you will
     * have two RequestHandlers for this two Intents. So in your HelpIntentHandler you can return true when you get an
     * IntentRequest with intent name AMAZON.HelpIntent.
     *
     * @param Request $request
     *
     * @return bool
     */
    abstract public function supportsRequest(Request $request): bool;

    /**
     * Handle the given request and return a response object or null.
     * Null may only be returned if Amazon does not allow a response to be sent. This is i.e. the case for a SessionEndedRequest.
     *
     * @param Request $request
     *
     * @return Response|null
     */
    abstract public function handleRequest(Request $request);
}
