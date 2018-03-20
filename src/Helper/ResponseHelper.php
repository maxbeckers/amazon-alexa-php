<?php

namespace MaxBeckers\AmazonAlexa\Helper;

use MaxBeckers\AmazonAlexa\Response\Card;
use MaxBeckers\AmazonAlexa\Response\Directives\Directive;
use MaxBeckers\AmazonAlexa\Response\OutputSpeech;
use MaxBeckers\AmazonAlexa\Response\Reprompt;
use MaxBeckers\AmazonAlexa\Response\Response;

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
     * ResponseHelper constructor creates a new response object.
     */
    public function __construct()
    {
        $this->response = new Response();
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
        $this->addResponseText($text, $endSession);

        return $this->response;
    }

    /**
     * Add a plaintext respond to response.
     *
     * @param string $text
     * @param bool   $endSession
     *
     * @return ResponseHelper
     */
    public function addResponseText(string $text, $endSession = false): ResponseHelper
    {
        $outputSpeech = OutputSpeech::createByText($text);

        $this->response->response->outputSpeech     = $outputSpeech;
        $this->response->response->shouldEndSession = $endSession;

        return $this;
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
        $this->addResponseSsml($ssml, $endSession);

        return $this->response;
    }

    /**
     * Add a ssml respond to response.
     *
     * @param string $ssml
     * @param bool   $endSession
     *
     * @return ResponseHelper
     */
    public function addResponseSsml(string $ssml, $endSession = false): ResponseHelper
    {
        $outputSpeech = OutputSpeech::createBySsml($ssml);

        $this->response->response->outputSpeech     = $outputSpeech;
        $this->response->response->shouldEndSession = $endSession;

        return $this;
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
        $this->addRepromptText($text);

        return $this->response;
    }

    /**
     * Add a plaintext reprompt to response.
     *
     * @param string $text
     *
     * @return ResponseHelper
     */
    public function addRepromptText(string $text): ResponseHelper
    {
        $outputSpeech = OutputSpeech::createByText($text);
        $reprompt     = new Reprompt($outputSpeech);

        $this->response->response->reprompt = $reprompt;

        return $this;
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
        $this->addRepromptSsml($ssml);

        return $this->response;
    }

    /**
     * Add a ssml reprompt to response.
     *
     * @param string $ssml
     *
     * @return ResponseHelper
     */
    public function addRepromptSsml(string $ssml): ResponseHelper
    {
        $outputSpeech = OutputSpeech::createBySsml($ssml);
        $reprompt     = new Reprompt($outputSpeech);

        $this->response->response->reprompt = $reprompt;

        return $this;
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
        $this->response->response->card = $card;

        return $this->response;
    }

    /**
     * Add a card to response.
     *
     * @param Card $card
     *
     * @return ResponseHelper
     */
    public function addCard(Card $card): ResponseHelper
    {
        $this->response->response->card = $card;

        return $this;
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
        $this->response->response->addDirective($directive);

        return $this->response;
    }

    /**
     * Add a directive to response.
     *
     * @param Directive $directive
     *
     * @return ResponseHelper
     */
    public function addDirective(Directive $directive): ResponseHelper
    {
        $this->response->response->addDirective($directive);

        return $this;
    }

    /**
     * Add a new attribute to response session attributes.
     *
     * @param string $key
     * @param string $value
     * @return ResponseHelper
     */
    public function addSessionAttribute(string $key, string $value): ResponseHelper
    {
        $this->response->sessionAttributes[$key] = $value;

        return $this;
    }

    /**
     * Reset the response in ResponseHelper.
     */
    public function resetResponse()
    {
        $this->response = new Response();
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
