<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Test\Response;

use MaxBeckers\AmazonAlexa\Helper\ResponseHelper;
use MaxBeckers\AmazonAlexa\Response\Card;
use MaxBeckers\AmazonAlexa\Response\Directives\Display\RenderTemplateDirective;
use MaxBeckers\AmazonAlexa\Response\OutputSpeech;
use PHPUnit\Framework\TestCase;

class ResponseHelperTest extends TestCase
{
    private const RESPOND = 'Respond';
    private const REPROMPT = 'Reprompt';

    public function testRespondText(): void
    {
        $responseHelper = new ResponseHelper();

        $response = $responseHelper->respond(self::RESPOND);

        $this->assertInstanceOf(OutputSpeech::class, $response->response->outputSpeech);
        $this->assertSame(self::RESPOND, $response->response->outputSpeech->text);
        $this->assertFalse($response->response->shouldEndSession);
    }

    public function testRespondTextEndSession(): void
    {
        $responseHelper = new ResponseHelper();

        $response = $responseHelper->respond(self::RESPOND, true);

        $this->assertInstanceOf(OutputSpeech::class, $response->response->outputSpeech);
        $this->assertSame(self::RESPOND, $response->response->outputSpeech->text);
        $this->assertTrue($response->response->shouldEndSession);
    }

    public function testRespondSsml(): void
    {
        $responseHelper = new ResponseHelper();

        $response = $responseHelper->respondSsml(self::RESPOND);

        $this->assertInstanceOf(OutputSpeech::class, $response->response->outputSpeech);
        $this->assertSame(self::RESPOND, $response->response->outputSpeech->ssml);
        $this->assertFalse($response->response->shouldEndSession);
    }

    public function testRespondSsmlEndSession(): void
    {
        $responseHelper = new ResponseHelper();

        $response = $responseHelper->respondSsml(self::RESPOND, true);

        $this->assertInstanceOf(OutputSpeech::class, $response->response->outputSpeech);
        $this->assertSame(self::RESPOND, $response->response->outputSpeech->ssml);
        $this->assertTrue($response->response->shouldEndSession);
    }

    public function testRepromptText(): void
    {
        $responseHelper = new ResponseHelper();

        $response = $responseHelper->reprompt(self::REPROMPT);

        $this->assertInstanceOf(OutputSpeech::class, $response->response->reprompt->outputSpeech);
        $this->assertSame(self::REPROMPT, $response->response->reprompt->outputSpeech->text);
    }

    public function testRepromptSsml(): void
    {
        $responseHelper = new ResponseHelper();

        $response = $responseHelper->repromptSsml(self::REPROMPT);

        $this->assertInstanceOf(OutputSpeech::class, $response->response->reprompt->outputSpeech);
        $this->assertSame(self::REPROMPT, $response->response->reprompt->outputSpeech->ssml);
    }

    public function testCard(): void
    {
        $responseHelper = new ResponseHelper();
        $testCard = new Card();

        $response = $responseHelper->card($testCard);

        $this->assertSame($testCard, $response->response->card);
    }

    public function testRenderTemplateDirective(): void
    {
        $responseHelper = new ResponseHelper();
        $renderTemplateDirective = new RenderTemplateDirective();

        $response = $responseHelper->directive($renderTemplateDirective);

        $this->assertSame($renderTemplateDirective, $response->response->directives[0]);
    }

    public function testRenderTemplateDirectives(): void
    {
        $responseHelper = new ResponseHelper();
        $renderTemplateDirective1 = new RenderTemplateDirective();
        $renderTemplateDirective2 = new RenderTemplateDirective();

        $responseHelper->directive($renderTemplateDirective1);
        $responseHelper->directive($renderTemplateDirective2);

        $this->assertSame($renderTemplateDirective1, $responseHelper->response->response->directives[0]);
        $this->assertSame($renderTemplateDirective2, $responseHelper->response->response->directives[1]);
    }

    public function testResetResponse(): void
    {
        $responseHelper = new ResponseHelper();
        $response1 = $responseHelper->getResponse();

        $responseHelper->resetResponse();
        $response2 = $responseHelper->getResponse();

        $this->assertNotSame($response1, $response2);
    }

    public function testAddSessionAttribute(): void
    {
        $responseHelper = new ResponseHelper();

        $responseHelper->addSessionAttribute('key', 'val');

        $this->assertSame($responseHelper->response->sessionAttributes, ['key' => 'val']);
    }
}
