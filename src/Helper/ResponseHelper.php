<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Helper;

use MaxBeckers\AmazonAlexa\Response\Card;
use MaxBeckers\AmazonAlexa\Response\Directives\Directive;
use MaxBeckers\AmazonAlexa\Response\OutputSpeech;
use MaxBeckers\AmazonAlexa\Response\Reprompt;
use MaxBeckers\AmazonAlexa\Response\Response;
use MaxBeckers\AmazonAlexa\Response\ResponseBody;

/**
 * This helper class can create simple responses for the most needed intents.
 */
class ResponseHelper
{
    public Response $response;
    public ResponseBody $responseBody;

    public function __construct()
    {
        $this->resetResponse();
    }

    /**
     * Add a plaintext respond to response.
     */
    public function respond(string $text, bool $endSession = false): Response
    {
        $outputSpeech = OutputSpeech::createByText($text);

        $this->responseBody->outputSpeech = $outputSpeech;
        $this->responseBody->shouldEndSession = $endSession;

        return $this->response;
    }

    /**
     * Add a ssml respond to response.
     */
    public function respondSsml(string $ssml, bool $endSession = false): Response
    {
        $outputSpeech = OutputSpeech::createBySsml($ssml);

        $this->responseBody->outputSpeech = $outputSpeech;
        $this->responseBody->shouldEndSession = $endSession;

        return $this->response;
    }

    /**
     * Add a plaintext reprompt to response.
     */
    public function reprompt(string $text): Response
    {
        $outputSpeech = OutputSpeech::createByText($text);
        $reprompt = new Reprompt($outputSpeech);

        $this->responseBody->reprompt = $reprompt;

        return $this->response;
    }

    /**
     * Add a ssml reprompt to response.
     */
    public function repromptSsml(string $ssml): Response
    {
        $outputSpeech = OutputSpeech::createBySsml($ssml);
        $reprompt = new Reprompt($outputSpeech);

        $this->responseBody->reprompt = $reprompt;

        return $this->response;
    }

    /**
     * Add a card to response.
     */
    public function card(Card $card): Response
    {
        $this->responseBody->card = $card;

        return $this->response;
    }

    /**
     * Add a directive to response.
     */
    public function directive(Directive $directive): Response
    {
        $this->responseBody->addDirective($directive);

        return $this->response;
    }

    /**
     * Add a new attribute to response session attributes.
     */
    public function addSessionAttribute(string $key, string $value): void
    {
        $this->response->sessionAttributes[$key] = $value;
    }

    /**
     * Reset the response in ResponseHelper.
     */
    public function resetResponse(): void
    {
        $this->responseBody = new ResponseBody();
        $this->response = new Response([], '1.0', $this->responseBody);
    }

    public function getResponse(): Response
    {
        return $this->response;
    }
}
