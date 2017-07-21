<?php

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
        $this->assertEquals(self::RESPOND, $response->response->outputSpeech->text);
        $this->assertEquals(false, $response->response->shouldEndSession);
    }

    public function testRespondTextEndSession()
    {
        $responseHelper = new ResponseHelper();

        $response = $responseHelper->respond(self::RESPOND, true);

        $this->assertInstanceOf(OutputSpeech::class, $response->response->outputSpeech);
        $this->assertEquals(self::RESPOND, $response->response->outputSpeech->text);
        $this->assertEquals(true, $response->response->shouldEndSession);
    }

    public function testRespondSsml()
    {
        $responseHelper = new ResponseHelper();

        $response = $responseHelper->respondSsml(self::RESPOND);

        $this->assertInstanceOf(OutputSpeech::class, $response->response->outputSpeech);
        $this->assertEquals(self::RESPOND, $response->response->outputSpeech->ssml);
        $this->assertEquals(false, $response->response->shouldEndSession);
    }

    public function testRespondSsmlEndSession()
    {
        $responseHelper = new ResponseHelper();

        $response = $responseHelper->respondSsml(self::RESPOND, true);

        $this->assertInstanceOf(OutputSpeech::class, $response->response->outputSpeech);
        $this->assertEquals(self::RESPOND, $response->response->outputSpeech->ssml);
        $this->assertEquals(true, $response->response->shouldEndSession);
    }

    public function testRepromptText()
    {
        $responseHelper = new ResponseHelper();

        $response = $responseHelper->reprompt(self::REPROMPT);

        $this->assertInstanceOf(OutputSpeech::class, $response->response->reprompt->outputSpeech);
        $this->assertEquals(self::REPROMPT, $response->response->reprompt->outputSpeech->text);
    }

    public function testRepromptSsml()
    {
        $responseHelper = new ResponseHelper();

        $response = $responseHelper->repromptSsml(self::REPROMPT);

        $this->assertInstanceOf(OutputSpeech::class, $response->response->reprompt->outputSpeech);
        $this->assertEquals(self::REPROMPT, $response->response->reprompt->outputSpeech->ssml);
    }

    public function testCard()
    {
        $responseHelper = new ResponseHelper();
        $testCard       = new Card();

        $response = $responseHelper->card($testCard);

        $this->assertEquals($testCard, $response->response->card);
    }

    public function testRenderTemplateDirective()
    {
        $responseHelper          = new ResponseHelper();
        $renderTemplateDirective = new RenderTemplateDirective();

        $response = $responseHelper->directive($renderTemplateDirective);

        $this->assertEquals($renderTemplateDirective, $response->response->directives[0]);
    }

    public function testRenderTemplateDirectives()
    {
        $responseHelper           = new ResponseHelper();
        $renderTemplateDirective1 = new RenderTemplateDirective();
        $renderTemplateDirective2 = new RenderTemplateDirective();

        $responseHelper->directive($renderTemplateDirective1);
        $responseHelper->directive($renderTemplateDirective2);

        $this->assertEquals($renderTemplateDirective1, $responseHelper->response->response->directives[0]);
        $this->assertEquals($renderTemplateDirective2, $responseHelper->response->response->directives[1]);
    }
}
