<?php

namespace MaxBeckers\AmazonAlexa\Tests;

use MaxBeckers\AmazonAlexa\Helper\ResponseHelper;
use MaxBeckers\AmazonAlexa\Response\Card;
use MaxBeckers\AmazonAlexa\Response\Directives\Display\RenderTemplateDirective;
use MaxBeckers\AmazonAlexa\Response\OutputSpeech;
use PHPUnit\Framework\TestCase;

/**
 * @author Maximilian Beckers <beckers.maximilian@gmail.com>
 */
class ResponseHelperTest extends TestCase
{
    const RESPOND  = 'Respond';
    const REPROMPT = 'Reprompt';

    public function testRespondText()
    {
        $responseHelper = new ResponseHelper();

        $response = $responseHelper->respond(self::RESPOND);

        $this->assertInstanceOf(OutputSpeech::class, $response->response->outputSpeech);
        $this->assertSame(self::RESPOND, $response->response->outputSpeech->text);
        $this->assertFalse($response->response->shouldEndSession);
    }

    public function testRespondTextEndSession()
    {
        $responseHelper = new ResponseHelper();

        $response = $responseHelper->respond(self::RESPOND, true);

        $this->assertInstanceOf(OutputSpeech::class, $response->response->outputSpeech);
        $this->assertSame(self::RESPOND, $response->response->outputSpeech->text);
        $this->assertTrue($response->response->shouldEndSession);
    }

    public function testRespondSsml()
    {
        $responseHelper = new ResponseHelper();

        $response = $responseHelper->respondSsml(self::RESPOND);

        $this->assertInstanceOf(OutputSpeech::class, $response->response->outputSpeech);
        $this->assertSame(self::RESPOND, $response->response->outputSpeech->ssml);
        $this->assertFalse($response->response->shouldEndSession);
    }

    public function testRespondSsmlEndSession()
    {
        $responseHelper = new ResponseHelper();

        $response = $responseHelper->respondSsml(self::RESPOND, true);

        $this->assertInstanceOf(OutputSpeech::class, $response->response->outputSpeech);
        $this->assertSame(self::RESPOND, $response->response->outputSpeech->ssml);
        $this->assertTrue($response->response->shouldEndSession);
    }

    public function testRepromptText()
    {
        $responseHelper = new ResponseHelper();

        $response = $responseHelper->reprompt(self::REPROMPT);

        $this->assertInstanceOf(OutputSpeech::class, $response->response->reprompt->outputSpeech);
        $this->assertSame(self::REPROMPT, $response->response->reprompt->outputSpeech->text);
    }

    public function testRepromptSsml()
    {
        $responseHelper = new ResponseHelper();

        $response = $responseHelper->repromptSsml(self::REPROMPT);

        $this->assertInstanceOf(OutputSpeech::class, $response->response->reprompt->outputSpeech);
        $this->assertSame(self::REPROMPT, $response->response->reprompt->outputSpeech->ssml);
    }

    public function testCard()
    {
        $responseHelper = new ResponseHelper();
        $testCard       = new Card();

        $response = $responseHelper->card($testCard);

        $this->assertSame($testCard, $response->response->card);
    }

    public function testRenderTemplateDirective()
    {
        $responseHelper          = new ResponseHelper();
        $renderTemplateDirective = new RenderTemplateDirective();

        $response = $responseHelper->directive($renderTemplateDirective);

        $this->assertSame($renderTemplateDirective, $response->response->directives[0]);
    }

    public function testRenderTemplateDirectives()
    {
        $responseHelper           = new ResponseHelper();
        $renderTemplateDirective1 = new RenderTemplateDirective();
        $renderTemplateDirective2 = new RenderTemplateDirective();

        $responseHelper->directive($renderTemplateDirective1);
        $responseHelper->directive($renderTemplateDirective2);

        $this->assertSame($renderTemplateDirective1, $responseHelper->response->response->directives[0]);
        $this->assertSame($renderTemplateDirective2, $responseHelper->response->response->directives[1]);
    }

    public function testResetResponse()
    {
        $responseHelper = new ResponseHelper();
        $response1      = $responseHelper->getResponse();

        $responseHelper->resetResponse();
        $response2 = $responseHelper->getResponse();

        $this->assertNotSame($response1, $response2);
    }

    public function testAddSessionAttribute()
    {
        $responseHelper = new ResponseHelper();

        $responseHelper->addSessionAttribute('key', 'val');

        $this->assertSame($responseHelper->response->sessionAttributes, ['key' => 'val']);
    }
}
