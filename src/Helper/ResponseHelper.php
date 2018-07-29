<?php

namespace MaxBeckers\AmazonAlexa\Helper;

use MaxBeckers\AmazonAlexa\Response\Card;
use MaxBeckers\AmazonAlexa\Response\Directives\Directive;
use MaxBeckers\AmazonAlexa\Response\OutputSpeech;
use MaxBeckers\AmazonAlexa\Response\Reprompt;
use MaxBeckers\AmazonAlexa\Response\Response;
use MaxBeckers\AmazonAlexa\Response\ResponseBody;

/**
 * This helper class can create simple responses for the most needed intents.
 *
 * @author Maximilian Beckers <beckers.maximilian@gmail.com>
 */
class ResponseHelper
{
    /**
     * @var Response
     */
    public $response;

    /**
     * @var ResponseBody
     */
    public $responseBody;

    /**
     * ResponseHelper constructor creates a new response object.
     */
    public function __construct()
    {
        $this->resetResponse();
    }

    /**
     * Add a plaintext respond to response.
     *
     * @param string $text
     * @param bool   $endSession
     *
     * @return Response
     */
    public function respond(string $text, $endSession = false): Response
    {
        $outputSpeech = OutputSpeech::createByText($text);

        $this->responseBody->outputSpeech     = $outputSpeech;
        $this->responseBody->shouldEndSession = $endSession;

        return $this->response;
    }

    /**
     * Add a ssml respond to response.
     *
     * @param string $ssml
     * @param bool   $endSession
     *
     * @return Response
     */
    public function respondSsml(string $ssml, $endSession = false): Response
    {
        $outputSpeech = OutputSpeech::createBySsml($ssml);

        $this->responseBody->outputSpeech     = $outputSpeech;
        $this->responseBody->shouldEndSession = $endSession;

        return $this->response;
    }

    /**
     * Add a plaintext reprompt to response.
     *
     * @param string $text
     *
     * @return Response
     */
    public function reprompt(string $text)
    {
        $outputSpeech = OutputSpeech::createByText($text);
        $reprompt     = new Reprompt($outputSpeech);

        $this->responseBody->reprompt = $reprompt;

        return $this->response;
    }

    /**
     * Add a ssml reprompt to response.
     *
     * @param string $ssml
     *
     * @return Response
     */
    public function repromptSsml(string $ssml)
    {
        $outputSpeech = OutputSpeech::createBySsml($ssml);
        $reprompt     = new Reprompt($outputSpeech);

        $this->responseBody->reprompt = $reprompt;

        return $this->response;
    }

    /**
     * Add a card to response.
     *
     * @param Card $card
     *
     * @return Response
     */
    public function card(Card $card)
    {
        $this->responseBody->card = $card;

        return $this->response;
    }

    /**
     * Add a directive to response.
     *
     * @param Directive $directive
     *
     * @return Response
     */
    public function directive(Directive $directive)
    {
        $this->responseBody->addDirective($directive);

        return $this->response;
    }

    /**
     * Add a new attribute to response session attributes.
     *
     * @param string $key
     * @param string $value
     */
    public function addSessionAttribute(string $key, string $value)
    {
        $this->response->sessionAttributes[$key] = $value;
    }

    /**
     * Reset the response in ResponseHelper.
     */
    public function resetResponse()
    {
        $this->responseBody = new ResponseBody();
        $this->response     = new Response([], "1.0", $this->responseBody);
    }

    /**
     * Get current response of response helper.
     *
     * @return Response
     */
    public function getResponse(): Response
    {
        return $this->response;
    }
}
